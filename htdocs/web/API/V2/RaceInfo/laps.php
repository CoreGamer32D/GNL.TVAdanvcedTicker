<?php
include("gnltv.inc.php");

if (isset($_GET['ajax'])) {
    $status = getServerStatus();
    if ($status === "OK" && isset($response["data"]["session"]) && $response["data"]["session"] === "Race") {
        echo ($response["data"]["lapsComplete"] + 1) . " | " . $response["data"]["lapsTotal"];
    } else {
        echo "NO DATA FOR LAPS";
    }
    exit;
}

$status = getServerStatus();
$lapsInfo = "";

if ($status === "OK" && isset($response["data"]["session"]) && $response["data"]["session"] === "Race") {
    $lapsInfo = ($response["data"]["lapsComplete"] + 1) . " | " . $response["data"]["lapsTotal"];
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
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .lap-container {
            font-size: 24px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
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
        .total-laps {
            font-size: 28px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="lap-container">
        <span class="label">LAP</span>
        <span id="laps-info" class="current-lap"><?php echo $lapsInfo ? $lapsInfo : "NO DATA FOR LAPS"; ?></span>
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
