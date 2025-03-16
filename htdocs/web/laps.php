<?php
include("gnltv.inc.php");

if (isset($_GET['ajax'])) {
    $status = getServerStatus();
    if ($status === "OK" && isset($response["data"]["session"]) && $response["data"]["session"] === "Race") {
        $lapsComplete = $response["data"]["lapsComplete"] + 1;
        $lapsTotal = $response["data"]["lapsTotal"];
        $lapsRemaining = $lapsTotal - $lapsComplete;

        if ($lapsRemaining == 2) {
            echo "2 LAPS TO GO";
        } elseif ($lapsRemaining == 0) {
            echo "1 LAPS TO GO";
        } elseif ($lapsRemaining <= -1) {
            echo "OFFICIAL RESULTS";
        } else {
            echo "$lapsComplete | $lapsTotal";
        }
    } else {
        echo "NO DATA FOR LAPS";
    }
    exit;
}

$status = getServerStatus();
$lapsInfo = "NO DATA FOR LAPS";

if ($status === "OK" && isset($response["data"]["session"]) && $response["data"]["session"] === "Race") {
    $lapsComplete = $response["data"]["lapsComplete"] + 1;
    $lapsTotal = $response["data"]["lapsTotal"];
    $lapsRemaining = $lapsTotal - $lapsComplete;

    if ($lapsRemaining == 2) {
        $lapsInfo = "2 LAPS TO GO";
    } elseif ($lapsRemaining == 0) {
        $lapsInfo = "1 LAPS TO GO";
    } elseif ($lapsRemaining <= -1) {
        $lapsInfo = "OFFICIAL RESULTS";
    } else {
        $lapsInfo = "$lapsComplete | $lapsTotal";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPS</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: left;
            align-items: left;
            height: 100vh;
            margin: 0;
        }
        .lap-container {
            font-size: 24px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: left;
            gap: 100px;
        }
        .label {
            color: gray;
            text-transform: uppercase;
            font-size: 16px;
        }
        .current-lap {
            font-size: 28px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="lap-container">
        <span id="laps-info" class="current-lap"><?php echo $lapsInfo; ?></span>
    </div>

    <script>
        function updateLaps() {
            fetch('?ajax=1')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('laps-info').innerText = data;
                })
                .catch(error => console.error('Error updating laps:', error));
        }

        setInterval(updateLaps, 1000); 
    </script>
</body>
</html>
