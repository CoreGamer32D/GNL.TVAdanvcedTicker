<?php
/**
 * Advanced NR2003 Racecast Marquee System
 * Enhanced for modern browsers and better performance.
 * Author: Peter Dikant (Modified by ChatGPT)
 */

include('gnltv.inc.php');

$status = getServerStatus();
$marqueeWidth = 800;
$marqueeHeight = 50;
$marqueeSpeed = 60; // Adjust speed dynamically

$standingsHTML = '<div class="marquee-content">';

if ($status != "OK") {
    $standingsHTML .= "<div class=\"server-status\">$status</div>";
} else {
    $standingsHTML .= '<img src="images/gnltv_logo.gif" width="100" height="18" class="logo" alt="GNL.TV Logo" />';
    $size = getStandingsNumber();

    if ($size == 0) {
        $standingsHTML .= '<span class="no-time">No times recorded yet.</span>';
    } else {
        for ($i = 0; $i < $size; $i++) {
            $standings = getStandings($i);
            $standingsHTML .= '<div class="driver">';
            $standingsHTML .= '<span class="position">'.($i + 1).'</span>';
            $standingsHTML .= '<span class="number"><img src="images/numbers/'.trim($standings['number']).'.png" class="number-image"></span>';
            $standingsHTML .= '<span class="name">'.$standings['name'].'</span>';
            $standingsHTML .= '<span class="time">'.getDriverTime($standings, $i).'</span>';
            $standingsHTML .= '</div>';
        }
    }
}
$standingsHTML .= '</div>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GNL.TV - <?php echo getTrackName(); ?></title>
    <link rel="stylesheet" href="css/marquee-style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #222;
            color: white;
            text-align: center;
            overflow-x: hidden;
        }

        .marquee-container {
            width: 100%;
            overflow: hidden;
            background: #000;
            height: 50px;
            padding: 10px 0;
            position: relative;
            white-space: nowrap;
        }

        .marquee-wrapper {
            display: flex;
            position: absolute;
            left: 100%;
            white-space: nowrap;
        }

        .marquee-content {
            display: flex;
            align-items: center;
            gap: 20px;
            padding-right: 50px;
        }

        .driver {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .name {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 13px;
            white-space: nowrap;
        }

        .position {
            background: gray;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 6px;
            text-align: center;
            min-width: 1px;
        }

        .number, .time {
            font-size: 16px;
            font-weight: bold;
        }

        .number img {
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="marquee-container">
        <div class="marquee-wrapper">
            <?php echo $standingsHTML; ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var marqueeWrapper = document.querySelector(".marquee-wrapper");
            var speed = <?php echo $marqueeSpeed; ?>; // Speed from PHP

            function scrollMarquee() {
                var firstItem = marqueeWrapper.firstElementChild;
                var containerWidth = document.querySelector(".marquee-container").offsetWidth;
                var contentWidth = marqueeWrapper.offsetWidth;

                marqueeWrapper.style.left = containerWidth + "px";

                function animate() {
                    var currentLeft = parseInt(marqueeWrapper.style.left);
                    if (currentLeft + contentWidth <= 0) {
                        marqueeWrapper.appendChild(firstItem);
                        marqueeWrapper.style.left = containerWidth + "px";
                    } else {
                        marqueeWrapper.style.left = (currentLeft - 2) + "px";
                    }
                    requestAnimationFrame(animate);
                }

                animate();
            }

            scrollMarquee();
        });
    </script>
</body>
</html>
