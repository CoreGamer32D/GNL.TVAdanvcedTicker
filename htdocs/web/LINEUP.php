<?php
/**
 * GNL.tv - NR2003 Racecast System
 * Copyright (C) 2003-2005 Peter Dikant (peter@dikant.de)
 */

// Get the session parameter (default to 1)
$tvsession = isset($_GET['gnltvsession']) ? intval($_GET['gnltvsession']) : 1;

include("gnltv.inc.php");

// Fetch race data
$status = getServerStatus();
$modName = htmlspecialchars(getModName());
$trackName = htmlspecialchars(getTrackName());
$sessionName = htmlspecialchars($response["data"]["session"] ?? 'Unknown Session');
$size = getStandingsNumber();

$standingsData = [];
for ($i = 0; $i < $size; $i++) {
    $standings = getStandings($i);
    $number = htmlspecialchars($standings["number"] ?? '00'); // Default to '00' if number is missing
    $name = htmlspecialchars($standings["name"] ?? 'Unknown');
    
    $standingsData[] = [
        'position' => $i + 1,
        'number' => $number,
        'name' => $name,
        'image' => "images/numbers/{$number}.png"
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qualifying Results</title>
    <meta http-equiv="refresh" content="3">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
    <style>
        @font-face {
            font-family: 'StainLess';
            src: url('./fonts/Stainless-Black.otf') format('truetype');
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            font-family: 'StainLess', sans-serif;
            text-align: center;
        }

        .results-container {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .results-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .driver-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
        }

        .position {
            font-size: 20px;
            font-weight: bold;
            width: 50px;
            text-align: center;
        }

        .number {
            display: flex;
            align-items: center;
        }

        .number img {
            height: 40px;
            width: auto;
        }

        .name {
            flex-grow: 1;
            text-align: left;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .results-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="results-container">
        <h1><?php echo "$modName - $trackName"; ?></h1>
        <h3>Session: <?php echo $sessionName; ?></h3>

        <?php if ($status != "OK"): ?>
            <div class="alert alert-danger"><?php echo $status; ?></div>
        <?php else: ?>
            <div class="results-grid">
                <?php
                $halfSize = ceil(count($standingsData) / 2);
                $leftColumn = array_slice($standingsData, 0, $halfSize);
                $rightColumn = array_slice($standingsData, $halfSize);
                ?>

                <!-- Left Column -->
                <div>
                    <?php foreach ($leftColumn as $driver): ?>
                        <div class="driver-row">
                            <div class="position"><?php echo $driver['position']; ?></div>
                            <div class="number">
                                <img src="<?php echo $driver['image']; ?>" onerror="this.src='images/numbers/default.png';">
                            </div>
                            <div class="name"><?php echo $driver['name']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Right Column -->
                <div>
                    <?php foreach ($rightColumn as $driver): ?>
                        <div class="driver-row">
                            <div class="position"><?php echo $driver['position']; ?></div>
                            <div class="name"><?php echo $driver['name']; ?></div>
                            <div class="number">
                                <img src="<?php echo $driver['image']; ?>" onerror="this.src='images/numbers/default.png';">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
