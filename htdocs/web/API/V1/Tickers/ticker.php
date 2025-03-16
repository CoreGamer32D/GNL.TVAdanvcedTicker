<?php
include('gnltv.inc.php');
header("Content-Type: text/html; charset=iso-8859-1");

function getTickerContent() {    
    $content .= '<div class="standings-container">';
    $status = getServerStatus();

    if ($status != "OK") {
        $content .= "<div class='serverstatus'>$status</div>";
    } else {
        $size = getStandingsNumber();
        if ($size == 0) {
            $content .= '<span class="notime">No drivers have completed a lap yet.</span>';
        } else {
            for ($i = 0; $i < $size; $i++) {
                $standings = getStandings($i);
                $position = $i + 1;
                $number = htmlspecialchars(trim($standings['number']));
                
                // Extract only the last name
                $nameParts = explode(' ', $standings['name']);
                $lastName = htmlspecialchars(end($nameParts));
                
                // Check if driver is a lap down
                $lapDown = isset($standings['lapDown']) ? $standings['lapDown'] : false;
                
                $content .= "<div class='standings-entry'>";
                $content .= "<span class='position'>$position</span>";
                $content .= "<span class='number'>$number</span>";
                $content .= "<span class='name'>$lastName</span>";
                
                if ($lapDown) {
                    $content .= "<span class='time'>Lap Down</span>";
                } else {
                    $time = getDriverTime($standings,  $i);
                    $content .= "<span class='time'>$time</span>";
                }
                
                $content .= "</div>";
            }
        }
    }
    $content .= '</div>';
    return $content;
}

if (isset($_GET['ajax'])) {
    echo getTickerContent();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="iso-8859-1">
    <title>Ticker</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .notime{
            color:rgb(255, 255, 255);
        }

        .standings-header {
            width: 160px;
            text-align: center;
            background: black;
            padding: 5px 0;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
        }

        .event-title {
            font-size: 11px;
            font-weight: bold;
        }

        .lap-counter {
            font-size: 10px;
            color: #bbbbbb;
        }

        .current-lap {
            color: #00ff00;
            font-weight: bold;
        }

        .standings-container {
            width: 160px;
            color:rgba(0, 0, 0, 0);
            padding: 5px;
            border-top: 1px solid #444;
        }

        .standings-entry {
            display: flex;
            align-items: center;
            padding: 2px 0;
            font-size: 10px;
        }

        .position {
            width: 12px;
            text-align: right;
            font-weight: bold;
            color: white;
            font-size: 9px;
        }

        .number {
            width: 22px;
            text-align: right;
            font-weight: bold;
            color: yellow;
            font-size: 10px;
        }

        .name {
            flex: 1;
            margin-left: 5px;
            color:rgb(255, 255, 255);
            font-weight: bold;
            font-size: 10px;
        }

        .time {
            text-align: right;
            font-size: 9px;
            color: #bbbbbb;
            margin-left: 5px;
        }
    </style>
    <script>
        function updateTicker() {
            fetch('?ajax=1')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('standings').innerHTML = data;
                })
                .catch(error => console.error('Error updating ticker:', error));
        }

        setInterval(updateTicker, 1000); 
    </script>
</head>
<body>
    <div id="standings">
        <?php echo getTickerContent(); ?>
    </div>
</body>
</html>
