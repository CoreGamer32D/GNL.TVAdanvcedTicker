<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
/**
 * GNL.tv - NR2003 Racecast System
 * Copyright (C) 2003-2005 Peter Dikant (peter@dikant.de)
 *
 * This program is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public
 * License for more details.
 *
 * You should have received a copy of the GNU General
 * Public License along with this program; if not,
 * write to the Free Software Foundation, Inc., 59
 * Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
 
/**
 * This is the main standings page. It will display the
 * current race status and detailed timing data for
 * each driver.
 * This page uses a tableless CSS layout. You can completely
 * customize the visual appereance of this page only by
 * modifying the css stylesheet, without the need to
 * change any code in here.
 *
 * @author Peter Dikant (peter@dikant.de)
 * @version $Id: racestats.php,v 1.9 2005/01/03 12:58:39 Peter Exp $
 */

include("gnltv.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zak Broadcasting</title>
    <meta http-equiv="refresh" content="10">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/gnl-style.css">
    <script defer src="js/racecast.js"></script>
</head>
<body>
    <div id="container">
        <header>
            <h1>ZAK.TV Broadcasting System</h1>
            <h1>Credits To GNL.TV</h1>
        </header>
        
        <main id="standings">
            <?php $status = getServerStatus(); ?>
            <div id="tracktitle">
                <?php echo ($status !== "OK") ? $status : getModName() . '' . getTrackName(); ?>
            </div>
            
            <?php printOldStandingLinks(); ?>
            
            <?php if ($response["data"]["session"] !== "Race") { ?>
                <div id="timeleft">Time Left: <span><?php echo $response["data"]["timeRemaining"]; ?></span></div>
            <?php } else { ?>
                <div id="raceinfo">
                    <p>LAPS <?php echo ($response["data"]["lapsComplete"] + 1) . " | " . $response["data"]["lapsTotal"]; ?></p>
                </div>
            <?php } ?>
            
            <div id="driversonline">Drivers: <?php echo $response["data"]["connectedDrivers"]; ?></div>
            
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <?php if ($response["data"]["session"] === "Race") echo '<th>Started</th>'; ?>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Last Lap / Speed</th>
                        <?php if ($response["data"]["session"] === "Race") { ?>
                            <th>Pitstops</th>
                            <th>Lead</th>
                        <?php } else { ?>
                            <th>Laps</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $size = getStandingsNumber();
                    for ($i = 0; $i < $size; $i++) {
                        $standings = getStandings($i);
                        echo "<tr>";
                        echo "<td>" . ($i + 1) . printUpDownMarker($standings, $i) . "</td>";
                        if ($response["data"]["session"] === "Race") echo "<td>" . getQualiPosition($standings) . "</td>";
                        echo "<td>" . $standings["number"] . "</td>";
                        echo "<td><img src='images/carmake_" . $standings["carmake"] . ".gif' alt='Car' width='22'> " . $standings["name"] . "</td>";
                        echo "<td>" . getDriverTime($standings, $i) . "</td>";
                        echo "<td>" . getDriverLastTime($standings) . "</td>";
                        if ($response["data"]["session"] === "Race") {
                            echo "<td>" . $standings["pitstops"] . "</td>";
                            echo "<td>" . getDriverLeadLaps($standings) . "</td>";
                        } else {
                            echo "<td>" . $standings["lap"] . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
        
        <footer>
            <p><a href="https://www.youtube.com/@Zak103tv/streams" target="_blank">ZAK.TV</a> v0.0.1     &copy; By Matthew Wilhite</p>
        </footer>
    </div>
    
    <script>
        document.getElementById("trackOverviewBtn").addEventListener("click", function() {
            window.open('gnltv-applet.php?track=<?php echo urlencode($response["data"]["track"]); ?>', 'Track', 'height=400,width=600,menubar=no,status=no,toolbar=no');
        });
        
        function refreshStandings() {
            fetch('racestats.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('standings').innerHTML = data;
                })
                .catch(error => console.error('Error refreshing standings:', error));
        }
        
        setInterval(refreshStandings, 10000);
    </script>
</body>
</html>

