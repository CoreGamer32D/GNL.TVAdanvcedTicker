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
 * This is the page that displays results of already completed
 * sessions. It is basically a stripped down version of the
 * race standings page.
 * This page uses a tableless CSS layout. You can completely
 * customize the visual appereance of this page only by
 * modifying the css stylesheet, without the need to
 * change any code in here.
 *
 * @author Peter Dikant (peter@dikant.de)
 * @version $Id: displaysession.php,v 1.1 2005/01/03 12:58:39 Peter Exp $
 */

if (isset($_GET['gnltvsession'])) {
    $tvsession = $_GET['gnltvsession'];
} else {
    $tvsession = 0;
}

include("gnltv.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zak DisplaySession</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/gnl-style.css">
    <script>
        function refreshResults() {
            location.reload();
        }
    </script>
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding-top: 20px;
        }
        .table {
            background: #1e1e1e;
            color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #2c2c2c;
        }
        .refresh-btn {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>

<div class="container">
    <header class="text-center my-4">
        <h1>GNL.tv Racecast System</h1>
        <h3><?php echo htmlspecialchars(getModName() . " - " . getTrackName()); ?></h3>
    </header>

    <?php
        $status = getServerStatus();
        if ($status != "OK") {
            echo "<div class='alert alert-danger text-center'>$status</div>";
        } else {
    ?>

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="text-primary"><?php echo htmlspecialchars($response["data"]["session"]); ?> Session Results</h4>
        <button class="btn btn-primary" onclick="refreshResults()">Refresh Results</button>
    </div>

    <table class="table table-dark table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>Position</th>
                <th>Number</th>
                <th>Name</th>
                <th>Time / Speed</th>
                <th>Laps</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $size = getStandingsNumber();
                for ($i = 0; $i < $size; $i++) {
                    $standings = getStandings($i);
            ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo htmlspecialchars($standings["number"]); ?></td>
                <td>
                    <img src="images/carmake_<?php echo htmlspecialchars($standings["carmake"]); ?>.gif" width="22" height="12" alt="Car Make">
                    <?php echo htmlspecialchars($standings["name"]); ?>
                </td>
                <td><?php echo htmlspecialchars(getDriverTime($standings, $i) . ' / ' . getDriverSpeed($standings)); ?></td>
                <td><?php echo htmlspecialchars($standings["lap"]); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="racestats.php" class="btn btn-outline-light">Back to Current Standings</a>
    </div>

    <?php } ?>

    <footer class="text-center mt-4">
    <p><a href="https://www.youtube.com/@Zak103tv/streams" target="_blank">ZAK.TV</a> v0.0.1     &copy; By Matthew Wilhite</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>