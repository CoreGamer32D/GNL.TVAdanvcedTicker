<?php
include("gnltv.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
    <style>
        body {
            background: transparent;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }
        #standings {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0);
            padding: 20px 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0);
        }
        #driversonline, #activesession {
            font-size: 1.2em;
            font-weight: bold;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div id="standings">
        <div id="activesession">
            <?php echo htmlspecialchars($response["data"]["session"]); ?> Session
        </div>
    </div>
</body>
</html>
