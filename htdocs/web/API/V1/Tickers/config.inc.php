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
 * This is the main configuration file for the GNLtv
 * web client.
 *
 * @author Peter Dikant (peter@dikant.de)
 * @version $Id: config.inc.php,v 1.10 2005/01/03 12:58:39 Peter Exp $
 */
 
// these variables define the GNL.tv server location
$tvserver = "localhost";
$tvport = 8000;

// port number of the gnltvproxy progam (optional)
$streamingport = 8001;

// update interval in miliseconds
// new data will only be fetched from server if the update interval has passed
$position_interval = 400;
$standings_interval = 10000;

// settings for the marquee scroller
$marqueewidth = '500px';
$marqueeheight = '22px';
$marqueespeed = 2;

/**
 * Each track should be defined in this section. Each entry describes
 * how to draw the car positions on a background image. Adding new tracks may
 * be done by creating a background image for the track (for example with the sandbox
 * tool from Project Wildfire) and adding a new line to the tracks array.
 *
 * name = detailed track name
 * file = filename of the background image
 * length = official track length in miles (used to calculate avg. speed)
 */
$tracks = array();
$tracks['Atlanta']              = array('name' => 'Atlanta Motor Speedway', 'file' => 'atlanta.svg', 'length' => 1.54);
$tracks['Bristol']              = array('name' => 'Bristol Motor Speedway', 'file' => 'bristol.svg', 'length' => 0.533);
$tracks['Bristol Night']        = array('name' => 'Bristol Motor Speedway', 'file' => 'bristol.svg', 'length' => 0.533);
$tracks['California']           = array('name' => 'California Speedway', 'file' => 'california.svg', 'length' => 2.0);
$tracks['Chicagoland']          = array('name' => 'Chicagoland Speedway', 'file' => 'chicagoland.svg', 'length' => 1.5);
$tracks['Coca Cola']            = array('name' => 'Coca-Cola Superspeedway', 'file' => 'coca_cola.svg', 'length' => 3.0);
$tracks['Darlington']           = array('name' => 'Darlington Raceway', 'file' => 'darlington.svg', 'length' => 1.366);
$tracks['Daytona']              = array('name' => 'Daytona International Speedway', 'file' => 'daytona.svg', 'length' => 2.5);
$tracks['Daytona Night']        = array('name' => 'Daytona International Speedway', 'file' => 'daytona.svg', 'length' => 2.5);
$tracks['Dover']                = array('name' => 'Dover International Speedway', 'file' => 'dover.svg', 'length' => 1.0);
$tracks['EuroSpeedway 1.0 FB']  = array('name' => 'Eurospeedway Lausitz', 'file' => 'eurospeedway.svg', 'length' => 2.0);
$tracks['Homestead']            = array('name' => 'Homestead-Miami Speedway', 'file' => 'homestead.svg', 'length' => 1.5);
$tracks['Indianapolis']         = array('name' => 'Indianapolis Motor Speedway', 'file' => 'indianapolis.svg', 'length' => 2.5);
$tracks['Infineon']             = array('name' => 'Infineon Raceway', 'file' => 'infineon.svg', 'length' => 2.0);
$tracks['Kansas']               = array('name' => 'Kansas Speedway', 'file' => 'kansas.svg', 'length' => 1.5);
$tracks['Las Vegas']            = array('name' => 'Las Vegas Motor Speedway', 'file' => 'las_vegas.svg', 'length' => 1.5);
$tracks['Lowes Night']          = array('name' => "Lowe's Motor Speedway", 'file' => 'lowes_night.svg', 'length' => 1.5);
$tracks['Martinsville']         = array('name' => 'Martinsville Speedway', 'file' => 'martinsville.svg', 'length' => 0.526);
$tracks['Michigan']             = array('name' => 'Michigan International Speedway', 'file' => 'michigan.svg', 'length' => 2.0);
$tracks['New Hampshire']        = array('name' => 'New Hampshire International Speedway', 'file' => 'new_hampshire.svg', 'length' => 1.058);
$tracks['North Carolina']       = array('name' => 'North Carolina Speedway', 'file' => 'north_carolina.svg', 'length' => 1.017);
$tracks['Phoenix']              = array('name' => 'Phoenix International Speedway', 'file' => 'phoenix.svg', 'length' => 1.0);
$tracks['Pocono']               = array('name' => 'Pocono Raceway', 'file' => 'pocono.svg', 'length' => 2.5);
$tracks['Portland Pwf Beta']    = array('name' => 'Portland International Raceway', 'file' => 'portland.svg', 'length' => 2.5);
$tracks['Richmond Night']       = array('name' => 'Richmond International Raceway', 'file' => 'richmond_night.svg', 'length' => 0.75);
$tracks['Riverside 1970']       = array('name' => 'Riverside International Raceway', 'file' => 'riverside_1970.svg', 'length' => 2.62);
$tracks['Sebring']              = array('name' => 'Sebring International Raceway', 'file' => 'sebring.svg', 'length' => 3.7);
$tracks['Talladega']            = array('name' => 'Talladega Superspeedway', 'file' => 'talladega.svg', 'length' => 2.66);
$tracks['Texas']                = array('name' => 'Texas Motor Speedway', 'file' => 'texas.svg', 'length' => 1.5);
$tracks['Watkins Glen']         = array('name' => 'Watkins Glen International', 'file' => 'watkins_glen.svg', 'length' => 2.45);
//
// the following tracks have been converted by =SR=Rwallacefan2 from www.simtelracing.com
//
$tracks['AtlantaBR']            = array('name' => 'Atlanta Motor Speedway', 'file' => 'atlantabr.svg', 'length' => 1.54);
$tracks['Bowman Gray Pwf']      = array('name' => 'Bowman Gray Stadium', 'file' => 'bowman_gray_pwf.svg', 'length' => 0.250);
$tracks['Californiabr']         = array('name' => 'California Speedway', 'file' => 'californiabr.svg', 'length' => 2.0);
$tracks['Chicagoland Iroc Pwf'] = array('name' => 'Chicagoland Speedway', 'file' => 'chicago_iroc_pwf.svg', 'length' => 1.5);
$tracks['Daytonabr']            = array('name' => 'Daytona International Speedway', 'file' => 'daytonabr.svg', 'length' => 2.5);
$tracks['Daytona NightBR']      = array('name' => 'Daytona International Speedway', 'file' => 'daytonabr.svg', 'length' => 2.5);
$tracks['Daytona Iroc Pwf']     = array('name' => 'Daytona International Speedway', 'file' => 'daytona_iroc_pwf.svg', 'length' => 2.5);
$tracks['DoverBR']              = array('name' => 'Dover International Speedway', 'file' => 'doverbr.svg', 'length' => 1.0);
$tracks['Eight Bowl']           = array('name' => 'Eight Bowl Superspeedway', 'file' => 'eight_bowl.svg', 'length' => 2.5);
$tracks['Evergreen Pwf']        = array('name' => 'Evergreen Raceway', 'file' => 'evergreen_pwf.svg', 'length' => 0.65);
$tracks['Hillside']             = array('name' => 'Hillside International Speedway', 'file' => 'hillside.svg', 'length' => 1.0);
$tracks['Homestead 2k3 Pwf']   = array('name' => 'Homestead-Miami Speedway', 'file' => 'homestead_2k3_pwf.svg', 'length' => 1.5);
$tracks['Houston Dx']           = array('name' => 'Houston Speedway', 'file' => 'houston_dx.svg', 'length' => 1.367);
$tracks['I70 Pwf']              = array('name' => 'I-70 Speedway', 'file' => 'i70_pwf.svg', 'length' => 0.49);
$tracks['Indianapolis Iroc Pwf']= array('name' => 'Indianapolis Motor Speedway', 'file' => 'indianapolis.svg', 'length' => 2.5);
$tracks['Indy Race Park Pwf']   = array('name' => 'Indianapolis Raceway Park', 'file' => 'irp_pwf.svg', 'length' => 0.686);
$tracks['Mansfield Pwf']        = array('name' => 'Mansfield Motorsports Speedway', 'file' => 'mansfield_pwf.svg', 'length' => 0.5);
$tracks['Mesa Marin Pwf']       = array('name' => 'Mesa Marin Raceway', 'file' => 'mesa_pwf.svg', 'length' => 0.5);
$tracks['MichiganBR']           = array('name' => 'Michigan International Speedway', 'file' => 'michiganbr.svg', 'length' => 2.0);
$tracks['Milwaukee Pwf']        = array('name' => 'The Milwaukee Mile', 'file' => 'milwaukee_pwf.svg', 'length' => 1.0);
$tracks['Mosport Pwf']          = array('name' => 'Mosport International Raceway', 'file' => 'mosport_pwf.svg', 'length' => 2.45);
$tracks['Nashville Pwf']        = array('name' => 'Nashville Fairgrounds', 'file' => 'nashville_pwf.svg', 'length' => 0.59);
$tracks['Nashville Ss Dx']      = array('name' => 'Nashville Superspeedway', 'file' => 'nashville_ss_dx.svg', 'length' => 1.058);
$tracks['North Texas Dx']       = array('name' => 'North Texas Speedway', 'file' => 'north_texas_dx.svg', 'length' => 0.250);
$tracks['Papyrus']              = array('name' => 'Papyrus Motorsports Park', 'file' => 'papyrus.svg', 'length' => 3.77);
$tracks['Route 66 Raceway Dx']  = array('name' => 'Route 66 Raceway', 'file' => 'route_66_raceway_dx.svg', 'length' => 0.75);
$tracks['Silverstone PWF BETA'] = array('name' => 'Silverstone', 'file' => 'silverstone_pwf.svg', 'length' => 2.94);
$tracks['Spring Creek Raceway Dx'] = array('name' => 'Spring Creek Raceway', 'file' => 'spring_creek_raceway_dx.svg', 'length' => 1.0);
$tracks['Talladega Iroc Pwf']   = array('name' => 'Talladega Superspeedway', 'file' => 'talladega_iroc_pwf.svg', 'length' => 2.66);
$tracks['TalladegaBR']          = array('name' => 'Talladega Superspeedway', 'file' => 'talladegabr.svg', 'length' => 2.66);
$tracks['Thompson Pwf']         = array('name' => 'Thompson Speedway', 'file' => 'thompson_pwf.svg', 'length' => 0.625);
$tracks['Trois Rivieres Pwf']   = array('name' => 'Trois Rivieres', 'file' => 'trois_rivieres_pwf.svg', 'length' => 1.52);
//
// the following tracks have been converted by Jukka Evaluoto
//
$tracks['Bullrun 102803 T8A']	= array('name' => 'Bullrun', 'file' => 'bullrun.svg', 'length' => 3.66);
$tracks['Gotzenburg']		= array('name' => 'G&ouml;tzenburg', 'file' => 'goetzenburg.svg', 'length' => 3.335);
$tracks['Jen']			= array('name' => 'JEN Valley', 'file' => 'jen.svg', 'length' => 2.130);
$tracks['Karjala']		= array('name' => 'Karjala Raceway', 'file' => 'karjala.svg', 'length' => 3.280);
$tracks['Kyalami Pwf Beta']	= array('name' => 'Kyalami', 'file' => 'kyalami.svg', 'length' => 2.47);
$tracks['Lake Afton']		= array('name' => 'Lake Afton', 'file' => 'lake_afton.svg', 'length' => 1.795);
$tracks[',imerock 4wist 63']	= array('name' => 'Lime Rock Park', 'file' => 'lime_rock.svg', 'length' => 1.530);
$tracks['MagnyCours 4R']	= array('name' => 'Magny-Cours', 'file' => 'magnycours.svg', 'length' => 2.64);
$tracks['Oldring']		= array('name' => 'OldRing | Brunec', 'file' => 'oldring.svg', 'length' => 3.57);
$tracks['Redrock']		= array('name' => 'Redrock Valley Speedway', 'file' => 'redrock.svg', 'length' => 2.92);
$tracks['Road Of Steel']	= array('name' => 'Road Of Steel', 'file' => 'road_of_steel.svg', 'length' => 3.56);
$tracks['Roadone International']= array('name' => 'Roadone International', 'file' => 'roadone.svg', 'length' => 4.799);

?>
