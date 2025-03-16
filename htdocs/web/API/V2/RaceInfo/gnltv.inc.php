<?php

include("config.inc.php");
include("xmlrpc.php");

error_reporting(E_ERROR);

if (isset($tvsession)) {
    $cachefile = "data/s".$tvsession."_standings.txt";
    $standings_interval = $standings_interval * 10;
} else {
    $cachefile = "data/standings.txt";
}

function getPrecisionTime() {
    list($msec, $sec) = split(" ", microtime());
    $msec = substr($msec, 0, 5);
    $sec = ($sec + $msec) * 1000;
    return $sec;
}

function formatTime($time) {
    if ($time < 60) {
	return sprintf("%01.3f", $time);
    }
    $minutes = (int) (($time - $time % 60) / 60);
    $time = $time - $minutes * 60;
    return sprintf("%d:%02.3f", $minutes, $time);
}

function convertMph($length, $time) {
    return ($length * 3600 / $time);
}

function printOldStandingLinks() {
    global $response;
    
    if ($response['data']['sessionNum'] > 0) {
        echo '<div id="crosslink"><a href="displaysession.php?gnltvsession=0">Show Practice Results</a>';
        if ($response['data']['sessionNum'] > 1) {
            echo ' | <a href="displaysession.php?gnltvsession=1">Show Qualifying Results</a>';
            if ($response['data']['sessionNum'] > 2) {
                echo ' | <a href="displaysession.php?gnltvsession=2">Show Happy-Hour Results</a>';
            }
        }
        echo "</div>\n";
    }
}

function getServerStatus() {
    global $response, $success;
    
    if ($success == false) {
        return "The GNL.tv server application is not running!";
    } else {
        if ($response["running"] == "false") {
            return "NR2003 has not been started!";
        } elseif ($response["atTrack"] == "false") { // is a track loaded?
            return "No track loaded!";
        } else {
            return "OK";
        }
    }
}

function getStandingsNumber() {
    global $response;
    
    $length = 0;
    if (isset($response["data"]["standings"])) {
        if (isset($response["data"]["standings"][0]["number"])) {
            $length = sizeof($response["data"]["standings"]);
        } else {
            $length = 1;
        }
    }
    return $length;
}

function getStandings($i) {
    global $response;
    
    if (isset($response["data"]["standings"][0]["number"])) {
        return $response["data"]["standings"][$i];
    } else {
        return $response["data"]["standings"];
    }
}
 
function getModName() {
    global $response;
    
    if ($response["data"]["mod"] == "cts") {
        return "Craftsman Truck Series: ";
    } elseif ($response["data"]["mod"] == "pta") {
        return "Trans-Am Series: ";
    } elseif ($response["data"]["mod"] == "bgn") {
        return "Grand National Series: ";
    }
}

function getTrackName() {
    global $response, $tracks;
    
    if ($tracks[$response["data"]["track"]]["name"] != "") {
        return $tracks[$response["data"]["track"]]["name"];
    } else {
        return $response["data"]["track"]; 
    }
}

function printFlagMarker() {
    global $response;
    
    if ($response["data"]["sessionFlag"] == "green") {
        if ($response["data"]["sessionState"] == "racing") {
            if (intval($response["data"]["lapsTotal"] - $response["data"]["lapsComplete"] - 1) == 1) {
                echo "<img src=\"images/whiteflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">White Flag</span>";
            } else {
                echo "<img src=\"images/greenflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">Green Flag</span>";
            }
        } elseif ($response["data"]["sessionState"] == "checkered" || $response["data"]["sessionState"] == "cool down") {
            echo "<img src=\"images/checkeredflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">Checkered Flag</span>";
        } else {
            echo "<strong>".$response["data"]["sessionState"]."</strong>";
        }
    } elseif ($response["data"]["sessionFlag"] == "yellow") {
        if ($response["data"]["sessionState"] == "racing") {
            echo "<img src=\"images/yellowflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">Yellow Flag</span>";
        } elseif ($response["data"]["sessionState"] == "checkered" || $response["data"]["sessionState"] == "cool down") {
            echo "<img src=\"images/yellowflag.gif\" width=\"21\" height=\"16\"/>"
                ."<img src=\"images/checkeredflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">Checkered Flag</span>";
        } else {
            echo "<span class=\"value\">".$response["data"]["sessionFlag"]."</span>";
        }
    } else {
        echo "<img src=\"images/redflag.gif\" width=\"21\" height=\"16\"/> <span class=\"value\">Red Flag</span>";
    }
}

function printUpDownMarker($standings, $i) {
    if (($i + 1) > $standings["lastpos"] && $standings["lastpos"] != -1) {
        echo "&nbsp; <img src=\"images/downarrow.gif\" widht=\"12\" height=\"12\"/>";
    } elseif (($i + 1) < $standings["lastpos"] && $standings["lastpos"] != -1) {
        echo "&nbsp; <img src=\"images/uparrow.gif\" width=\"12\" height=\"12\"/>";
    }
}

function getQualiPosition($standings) {
    if ($standings["started"] != -1) {
        return "$standings[started]";
    } else {
        return "&nbsp;";
    }
}

function getDriverTime($standings, $i) {
    global $response;
    
    $time = "";
    
    if ($response["data"]["session"] == "Race" && $i > 0) {
        $time .= "-";
    }

    if ($standings["lap"] > 0 && $response["data"]["session"] == "Race") {
        $time .= "$standings[lap]L";

        if ($standings["lap"] == 0 && ($standings["status"] == "running" || 
            $standings["status"] == "black flag" || $standings["status"] == "pitting")) {
            $time .= " (-".formatTime($standings["time"]).")";
        }
    } else {
        $time .= formatTime($standings["time"]);
    }
    
    return $time;
}


function getDriverSpeed($standings) {
    global $tracklength;
    
    return sprintf("%.3f", convertMph($tracklength, $standings["time"]));
}


function getDriverLastTime($standings) {
    global $tracklength;
    
    if ($standings["status"] == "running" || $standings["status"] == "black flag" || $standings["status"] == "pitting") {
        return formatTime($standings["lastlap"])." / ".sprintf("%.3f", convertMph($tracklength, $standings["lastlap"]));
    } else {
        return "&nbsp;";
    }
}


function getDriverLeadLaps($standings) {
    if (isset($standings["leadLaps"])) {
        return $standings["leadLaps"];
    } else {
        return 0;
    }
}

function getColorStatus($standings) {
    if ($standings["status"] == "running") {
        return "<span class=\"okstat\">running</span>";
    } elseif ($standings["status"] == "pitting") {
        return "<span class=\"pitstat\">pitting</span>";
    } elseif ($standings["status"] == "black flag" || $standings["status"] == "disqualified") {
        return "<span closs=\"penaltystat\">$standings[status]</span>";
    } else {
        return "<span closs=\"problemstat\">$standings[status]</span>";
    }
}

$reload = true;
if (file_exists($cachefile) && is_file($cachefile)) {
    $fd = fopen($cachefile, 'r');
    $data = fread($fd, filesize($cachefile));
    fclose($fd);
    $response = XMLRPC_parse($data);
    $response = $response["serverResponse"];
    if ((getPrecisionTime() - $response["timestamp"]) < $standings_interval) {
        $reload = false;
        $success = true;
    }
}
if ($reload) {
    if (isset($tvsession)) {
        $params['session'] = 0 + $tvsession;
        list($success, $response) = XMLRPC_request("$tvserver:$tvport", "", "getstatistics", array(XMLRPC_prepare($params)));
    } else {
        list($success, $response) = XMLRPC_request("$tvserver:$tvport", "", "getstatistics");
    }
    if ($success) {

        if (isset($response["compressedData"])) {
            $unzipped = gzuncompress(base64_decode($response["compressedData"]));
            $data = XMLRPC_parse($unzipped);
            $response["data"] = $data["data"];
            $response["compressedData"] = "";
        }
        $response["timestamp"] = getPrecisionTime();
        $export["serverResponse"] = $response;
        $fh = fopen($cachefile, 'w');
        fwrite($fh, XML_serialize($export));
        fclose($fh);
    }
}

if (isset($tvsession)) {
    switch ($tvsession) {
    case 0:
        $response["data"]["session"] = "Practice";
        break;
    case 1:
        $response["data"]["session"] = "Qualifying";
        break;
    case 2:
        $response["data"]["session"] = "Happy-Hour";
        break;
    default:
        $response["data"]["session"] = "Race";
    }
}

$tracklength = ($tracks[$response["data"]["track"]]["length"] != "") ? $tracks[$response["data"]["track"]]["length"] : ($response["data"]["trackLength"] / 1609);
?>