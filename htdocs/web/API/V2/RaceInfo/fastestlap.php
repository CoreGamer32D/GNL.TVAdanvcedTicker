<?php
include("gnltv.inc.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3">
    <title>Drivers Online</title>
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
#fastestlap {
            font-size: 1.2em;
            font-weight: bold;
            margin: 5px 0;
        }
        .value {
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <div id="standings">
        <?php if (!empty($response["data"]["fastestDriverName"])) { ?>
            <div id="fastestlap">
                FASTEST LAP: 
                <span class="value"><?php echo sprintf("%.3f", $response["data"]["fastestLap"]); ?></span> 
                BY <span class="value"><?php echo htmlspecialchars($response["data"]["fastestDriverName"]); ?></span>
            </div>
        <?php } ?>
    </div>
</body>
</html>
