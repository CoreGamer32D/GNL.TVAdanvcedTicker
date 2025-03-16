<?php
include("gnltv.inc.php");

$status = getServerStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name</title>
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
        }
        #standings {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0);
            padding: 20px 40px;
            border-radius: 10px;
            color: white;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0);
        }
        #tracktitle {
            font-weight: bold;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <main id="standings">
        <div id="tracktitle">
            <?php echo ($status !== "OK") ? $status : getModName() . ' ' . getTrackName(); ?>
        </div>
    </main>
</body>
</html>