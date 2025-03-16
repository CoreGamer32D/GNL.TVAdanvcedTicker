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
 * This is a variation of the race statistics page that
 * displays the current race standings in a marquee scroller
 * type fashion.
 *
 * @author Peter Dikant (peter@dikant.de)
 * @version $Id: marqueestats.php,v 1.2 2005/01/03 12:58:39 Peter Exp $
 */
 
include('gnltv.inc.php');

$content = '<nobr><div class="marqueestandings">';

$status = getServerStatus();
if ($status != "OK") {
    $content .= "<div class=\"serverstatus\">$status</div>";
} else {
    $content .= '<img src="images/gnltv_logo.gif" width="100" height="18" align="miodle" alt="" />';
    $size = getStandingsNumber();
    if ($size == 0) {
        $content .= '<span class="notime">No time recorded yet in this session.</span>';
    }
    for ($i = 0; $i < $size; $i++) {
        $standings = getStandings($i);
        $content .= '<span class="position">'.($i + 1).'</span>';
        $content .= '<span class="number">'.trim($standings['number']).'</span>';
        $content .= '<span class="name">'.$standings['name'].'</span>';
        $content .= '<span class="time">'.getDriverTime($standings, $i).'</span>';
    }
}
$content .= '</div></nobr>';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>GNL.TV - <?php echo getTrackName(); ?></title>
<style type="text/css">
@import "css/marquee-style.css";
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body>
<script language="JavaScript1.2">
/*
Cross browser Marquee script- � Dynamic Drive (www.dynamicdrive.com)
For full source code, 100's more DHTML scripts, and Terms Of Use, visit http://www.dynamicdrive.com
Credit MUST stay intact
*/

//Specify the marquee's width (in pixels)
var marqueewidth = "<?php echo $marqueewidth; ?>";
//Specify the marquee's height
var marqueeheight = "<?php echo $marqueeheight; ?>";
//Specify the marquee's marquee speed (larger is faster 1-10)
var marqueespeed = <?php echo $marqueespeed; ?>;
//Pause marquee onMousever (0=no. 1=yes)?
var pauseit = 0;

//Specify the marquee's content (don't delete <nobr> tag)
//Keep all content on ONE line, and backslash any single quotations (ie: that\'s great):

var marqueecontent = '<?php echo $content; ?>'

////NO NEED TO EDIT BELOW THIS LINE////////////
marqueespeed = (document.all) ? marqueespeed : Math.max(1, marqueespeed - 1); //slow speed down by 1 for NS
var copyspeed = marqueespeed;
var pausespeed = (pauseit==0) ? copyspeed : 0;
var iedom=document.all||document.getElementById;
var lefttime;

if (iedom) {
    document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+marqueecontent+'</span>');
}

var actualwidth='';
var cross_marquee, ns_marquee;

function populate() {
    if (iedom) {
        cross_marquee = document.getElementById ? document.getElementById("iemarquee") : document.all.iemarquee;
        cross_marquee.style.left = parseInt(marqueewidth) + 8 + "px";
        cross_marquee.innerHTML = marqueecontent;
        actualwidth=document.all ? temp.offsetWidth : document.getElementById("temp").offsetWidth;
    } else if (document.layers) {
        ns_marquee = document.ns_marquee.document.ns_marquee2;
        ns_marquee.left = parseInt(marqueewidth) + 8;
        ns_marquee.document.write(marqueecontent);
        ns_marquee.document.close();
        actualwidth=ns_marquee.document.width;
    }
    lefttime=setInterval("scrollmarquee()", 20);
}

window.onload = populate;

function scrollmarquee() {
    if (iedom) {
        if (parseInt(cross_marquee.style.left) > (actualwidth * (-1) + 8)) {
            cross_marquee.style.left = parseInt(cross_marquee.style.left) - copyspeed + "px";
        } else {
            clearInterval(lefttime);
            document.location.reload(true);
        } 
    } else if (document.layers) {
        if (ns_marquee.left > (actualwidth * (-1) + 8)) {
            ns_marquee.left -= copyspeed;
        } else {
            clearInterval(lefttime);
            document.location.reload(true);
        }
    }
}

if (iedom || document.layers) {
    with (document) {
        document.write('<table border="0" cellspacing="0" cellpadding="0"><td>');
        if (iedom) {
            write('<div style="position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden">');
            write('<div style="position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">');
            write('<div id="iemarquee" style="position:absolute;left:0px;top:0px"></div>');
            write('</div></div>');
        } else if (document.layers) {
            write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name="ns_marquee" bgColor='+marqueebgcolor+'>');
            write('<layer name="ns_marquee2" left=0 top=0 onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed"></layer>');
            write('</ilayer>');
        }
        document.write('</td></table>');
    }
}
</script>
</body>
</html>