<?php
include("gnltv.inc.php"); // Include your data file

// Check if the response data is available
$showFastestLap = !empty($response["data"]["fastestLap"]) && !empty($response["data"]["fastestDriverName"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="17">
    <title>Fastest Lap</title>
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
            overflow: hidden;
        }

        #standings {
            background-image: url("images/FL-Graphic.gif");
            background-size: auto;
            padding: 20px 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0);
            position: absolute;
            top: 50%;
            right: -100%; /* Start from the right */
            transform: translateY(-50%);
            opacity: 0;
            transition: right 1s ease-out, opacity 1s ease-out;
        }

        #standings.show {
            right: 50%; /* Move to the left center */
            transform: translateX(50%) translateY(-50%);
            opacity: 1;
        }

        #standings.fade-out {
            opacity: 0;
        }

        #fastestlap {
            font-size: 1.75em;
            font-weight: bold;
            margin: 1.25em;
        }

        .value {
            color: #ffcc00;
        }
    </style>
</head>

<body>
    <?php if ($showFastestLap) { ?>
    <article id="standings">
        <section id="fastestlap">
            <span class="value"><?php echo sprintf("%.3f", $response["data"]["fastestLap"]); ?></span>
            BY <span class="value"><?php echo htmlspecialchars($response["data"]["fastestDriverName"]); ?></span>
        </section>
    </article>
    <script>
        window.onload = function() {
            const standingsElement = document.getElementById("standings");
            standingsElement.classList.add("show");

            // After 15 seconds, fade out the element
            setTimeout(function() {
                standingsElement.classList.add("fade-out");
            }, 15000); // 15000 milliseconds = 15 seconds
        };
    </script>
    <?php } ?>
</body>

</html>
