<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOX Season 3 Racing Schedule</title>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg,rgb(54, 87, 199) 0%,rgb(108, 51, 141) 100%);
            --text-color: #ffffff;
            --highlight-color: #ffff00; /* Yellow highlight color */
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background: var(--primary-gradient);
            color: var(--text-color);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h1 {
            font-size: 6rem;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 0;
        }
        
        h2 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }
        
        .schedule-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .race-card {
            display: flex;
            align-items: center;
            height: 60px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .current-race {
            outline: none;
            box-shadow: 0 0 20px var(--highlight-color), 0 8px 25px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
            position: relative;
        }
        
        .current-race::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px solid var(--highlight-color);
            border-radius: 12px;
            animation: pulse 2s infinite;
            z-index: 1;
            pointer-events: none;
        }
        
        .race-number {
            width: 60px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }
        
        .track-logo {
            width: 60px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            padding: 5px;
        }
        
        .track-logo img {
            max-width: 100%;
            max-height: 100%;
        }
   
        .track-name {
            flex-grow: 1;
            font-size: 2.2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 20px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .track-name::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            z-index: -1;
        }
        
        .race-date {
            font-size: 2rem;
            font-weight: bold;
            padding: 0 25px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 30, 0.6);
            width: 120px;
            border-radius: 0 12px 12px 0;
            position: relative;
            overflow: hidden;
        }

        .race-date::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.3), transparent);
        }
        
        /* Style for past events */
        .past-event {
            opacity: 0.7;
            position: relative;
        }
        
        .past-event::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--text-color);
            z-index: 10;
        }
        
        .past-event .track-name,
        .past-event .race-number,
        .past-event .race-date {
            text-decoration: line-through;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 0, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 0, 0);
            }
        }
        
        .daytona { 
            background: linear-gradient(to right, #333333, #555555);
        }
        .kansas { 
            background: linear-gradient(to right, #3a64d8, #5a84f8);
        }
        .north-wilkesboro { 
            background: linear-gradient(to right, #d32f2f, #f44336);
        }
        .watkins-glen { 
            background: linear-gradient(to right, #0088cc, #00aaff);
        }
        .texas { 
            background: linear-gradient(to right, #e64a19, #ff6347);
        }
        .gateway { 
            background: linear-gradient(to right, #003366, #004c8c);
        }
        .talladega { 
            background: linear-gradient(to right, #d4a017, #f2b600);
        }
        .rockingham { 
            background: linear-gradient(to right, #333333, #555555);
        }
        .richmond { 
            background: linear-gradient(to right, #1a237e, #3366cc);
        }
        .portland { 
            background: linear-gradient(to right, #ad1457, #e91e63);
        }
        .homestead-miami { 
            background: linear-gradient(to right, #00796b, #009688);
        }
        .atlanta { 
            background: linear-gradient(to right, #b71c1c, #d32f2f);
        }
        
        .loading {
            text-align: center;
            font-size: 1.5rem;
            padding: 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 4rem;
            }
            
            h2 {
                font-size: 2.5rem;
                letter-spacing: 4px;
            }
            
            .race-number {
                font-size: 1.8rem;
                width: 50px;
            }
            
            .track-logo {
                width: 90px;
            }
            
            .track-name {
                font-size: 1.5rem;
            }
            
            .race-date {
                font-size: 1.5rem;
                width: 100px;
            }
            
            .container {
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }
            
            h1 {
                font-size: 3rem;
            }
            
            h2 {
                font-size: 1.8rem;
                letter-spacing: 3px;
            }
            
            .race-number {
                font-size: 1.5rem;
                width: 40px;
            }
            
            .track-logo {
                width: 90px;
            }
            
            .track-name {
                font-size: 1.2rem;
                padding: 0 10px;
            }
            
            .race-date {
                font-size: 1.2rem;
                width: 85px;
                padding: 0 10px;
            }
            .container {
                padding: 15px;
                border-radius: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>SOX</h1>
            <h2>S3 SCHEDULE</h2>
        </header>
        
        <div id="schedule-container" class="schedule-container">
            <!-- Schedule will be populated here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hardcoded data to match the image
            const scheduleData = [
                { number: 1, track: 'Daytona', date: '03/20', logo: 'https://www.daytonainternationalspeedway.com/wp-content/uploads/sites/1025/2024/05/30/cropped-Daytona-Intl-Speed-C-330x134-1.png', class: 'daytona' },
                { number: 2, track: 'Auto Club', date: '03/27', logo: 'https://upload.wikimedia.org/wikipedia/fr/a/a5/Auto_Club_Speedway_logo.jpg', class: 'kansas' },
                { number: 3, track: 'Thompson', date: '04/03', logo: 'https://cdn.thompsonspeedway.com/wp-content/uploads/2022/03/logo.png?strip=all&lossy=1&ssl=1', class: 'north-wilkesboro' },
                { number: 4, track: 'Pocono', date: '04/10', logo: 'https://www.poconoraceway.com/wp-content/uploads/2012/01/Pocono-Raceway-Marketing-Logo.png', class: 'watkins-glen' },
                { number: 5, track: 'Old Spice', date: '04/17', logo: 'https://pbs.twimg.com/profile_images/1602327883560648709/E5mfdEVO_400x400.jpg', class: 'texas' },
                { number: 6, track: 'Talladega', date: '04/24', logo: 'https://www.talladegasuperspeedway.com/wp-content/uploads/sites/1030/2024/08/05/Talladega_LogosRGB-1.svg', class: 'gateway' },
                { number: 7, track: 'North Wilkesboro', date: '05/01', logo: 'https://www.northwilkesborospeedway.com/images/uploads/logo.png', class: 'talladega' },
                { number: 8, track: 'Kansas', date: '05/08', logo: 'https://www.kansasspeedway.com/wp-content/uploads/sites/1036/2024/08/22/KSC_Logo2.svg', class: 'rockingham' },
                { number: 9, track: 'Atlanta', date: '05/15', logo: 'https://cdn.freebiesupply.com/logos/large/2x/atlanta-motor-speedway-logo-svg-vector.svg', class: 'atlanta' },
                { number: 10, track: 'Watkins Glen', date: '05/22', logo: 'https://www.theglen.com/wp-content/uploads/sites/1022/2024/07/23/WGI-1.svg', class: 'watkins-glen' },
                { number: 11, track: 'Richmond', date: '05/29', logo: 'https://www.richmondraceway.com/wp-content/uploads/sites/1028/2024/08/05/RR_Primary-Horiz_OnWht_RGB-Corrected.svg', class: 'homestead-miami' },
                { number: 12, track: 'Homestead', date: '06/05', logo: 'https://www.homesteadmiamispeedway.com/wp-content/uploads/sites/1038/2024/07/24/HomesteadMiami_Primary_OnWht_RGB-1.svg', class: 'atlanta' }
            ];
            
            // Helper function to convert MM/DD format to current year date
            function convertToDate(dateStr) {
                const currentYear = new Date().getFullYear();
                const [month, day] = dateStr.split('/');
                return new Date(currentYear, parseInt(month) - 1, parseInt(day));
            }
            
            // Function to check if a date is today
            function isToday(dateStr) {
                const today = new Date();
                const raceDate = convertToDate(dateStr);
                
                return today.getDate() === raceDate.getDate() && 
                       today.getMonth() === raceDate.getMonth();
            }
            
            // Function to check if a date is in the past
            function isPast(dateStr) {
                const today = new Date();
                const raceDate = convertToDate(dateStr);
                
                // Set time to beginning of day for accurate comparison
                today.setHours(0, 0, 0, 0);
                raceDate.setHours(0, 0, 0, 0);
                
                return raceDate < today;
            }
            
            // Function to fetch data from Google Sheets (for later implementation)
            async function fetchScheduleData() {
                try {
                    // Replace with your actual Google Sheet ID
                    const sheetId = 'YOUR_GOOGLE_SHEET_ID';
                    const sheetName = 'Sheet1';
                    const url = `https://docs.google.com/spreadsheets/d/${sheetId}/gviz/tq?tqx=out:csv&sheet=${sheetName}`;
                    
                    // For now, return hardcoded data
                    return scheduleData;
                    
                    // Uncomment for actual Google Sheets implementation
                    /*
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Failed to fetch data');
                    }
                    
                    const csvData = await response.text();
                    return parseCSV(csvData);
                    */
                } catch (error) {
                    console.error('Error fetching data:', error);
                    throw error;
                }
            }
            
            // Function to parse CSV data
            function parseCSV(csvText) {
                const lines = csvText.split('\n');
                const headers = lines[0].split(',');
                
                return lines.slice(1).map(line => {
                    const values = line.split(',');
                    const entry = {};
                    
                    headers.forEach((header, index) => {
                        entry[header.trim()] = values[index]?.trim();
                    });
                    
                    return entry;
                });
            }
            
            // Function to render schedule
            function renderSchedule(data) {
                const container = document.getElementById('schedule-container');
                container.innerHTML = '';
                
                data.forEach(race => {
                    const card = document.createElement('div');
                    card.className = 'race-card';
                    
                    // Check if this race is today
                    if (isToday(race.date)) {
                        card.classList.add('current-race');
                    }
                    
                    // Check if this race is in the past
                    if (isPast(race.date)) {
                        card.classList.add('past-event');
                    }
                    
                    card.innerHTML = `
                        <div class="race-number">${race.number}.</div>
                        <div class="track-logo">
                            <img src="${race.logo}" alt="${race.track} logo" />
                        </div>
                        <div class="track-name ${race.class}">${race.track}</div>
                        <div class="race-date">${race.date}</div>
                    `;
                    
                    container.appendChild(card);
                });
            }
            
            // Initialize
            async function init() {
                try {
                    const data = await fetchScheduleData();
                    renderSchedule(data);
                } catch (error) {
                    const container = document.getElementById('schedule-container');
                    container.innerHTML = `
                        <div class="loading">
                            Failed to load schedule data. Please try again later.
                        </div>
                    `;
                }
            }
            
            init();
        });
    </script>
</body>
</html>