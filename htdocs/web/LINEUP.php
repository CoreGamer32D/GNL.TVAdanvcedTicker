<?php
/**
* * GNL.tv - NR2003 Racecast System*
* * Copyright (C) 2003-2005 Peter Dikant (peter@dikant.de)*
* */
if (isset($_GET['gnltvsession'])) {
    $tvsession = $_GET['gnltvsession'];
} else {
    $tvsession = 1;
}
include("gnltv.inc.php");
$status = getServerStatus();
$modName = htmlspecialchars(getModName());
$trackName = htmlspecialchars(getTrackName());
$sessionName = htmlspecialchars($response["data"]["session"]);
$size = getStandingsNumber();
$standingsData = array();
for ($i = 0; $i < $size; $i++) {
    $standings = getStandings($i);
    $standingsData[] = array(
        'position' => $i + 1,
        'number' => htmlspecialchars($standings["number"]),
        'name' => htmlspecialchars($standings["name"]),
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qualifying Results</title>
    <meta http-equiv="refresh" content="3">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'StainLess';
            src: url('./fonts/Stainless-Black.otf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            font-family: StainLess;
            overflow: hidden;
        }
        
        .results-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding-top: 150px; /* Adjust based on your background image */
        }
        
        .results-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            width: 100%;
        }
        
        /* Left column layout */
        .left-driver-row {
            display: grid;
            grid-template-columns: 15% 15% 70%;
            height: 50px;
            align-items: center;
            margin-bottom: 10px;
        }
        
        /* Right column layout - reordered */
        .right-driver-row {
            display: grid;
            grid-template-columns: 15% 70% 15%;
            height: 50px;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .pos-cell {
            background-color:rgba(128, 128, 128, 0);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .number-cell {
            background-color: transparent;
            color: #fff;
            font-weight: bold;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .name-cell {
            background-color:rgba(128, 128, 128, 0);
            color: #fff;
            font-weight: bold;
            text-align: left;
            padding-left: 20px;
            height: 100%;
            display: flex;
            align-items: center;
        }
        
        /* Right-aligned name for right column */
        .name-cell-right {
            background-color:rgba(128, 128, 128, 0);
            color: #fff;
            font-weight: bold;
            text-align: right;
            padding-right: 20px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="results-container">
        <?php if ($status != "OK"): ?>
            <div style="text-align: center; padding: 20px; color: red;">
                <?php echo $status; ?>
            </div>
        <?php else: ?>
            <div class="results-grid">
                <?php
                $halfSize = ceil(count($standingsData) / 2);
                $leftColumn = array_slice($standingsData, 0, $halfSize);
                $rightColumn = array_slice($standingsData, $halfSize);
                ?>
                
                <!-- Left Column -->
                <div class="column">
                    <?php foreach ($leftColumn as $driver): ?>
                        <div class="left-driver-row">
                            <div class="pos-cell"><?php echo $driver['']; ?></div>
                            <div class="number-cell"><?php echo $driver['number']; ?></div>
                            <div class="name-cell"><?php echo $driver['name']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Right Column -->
                <div class="column">
                    <?php foreach ($rightColumn as $driver): ?>
                        <div class="right-driver-row">
                            <div class="pos-cell"><?php echo $driver['']; ?></div>
                            <div class="name-cell-right"><?php echo $driver['name']; ?></div>
                            <div class="number-cell"><?php echo $driver['number']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>