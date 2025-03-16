<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOX Season 3 Racing Schedule - Stream Overlay</title>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #d91e36 0%, #3a3e9d 100%);
            --text-color: #ffffff;
            --overlay-bg: rgb(71, 71, 71); /* Semi-transparent background */
            --border-radius: 10px;
            --gap: 15px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            z-index: 9999;
            pointer-events: none; /* Allows clicks to pass through the overlay */
        }
        
        .container {
            max-width: 600px;
            width: 100%;
            background: var(--overlay-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }
        
        header {
            text-align: center;
            margin-bottom: 15px;
        }
        
        h1 {
            color:rgb(255, 255, 255);
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 0;
        }
        
        h2 {
            color:rgb(255, 255, 255);
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }
        
        .schedule-container {
            display: flex;
            flex-direction: column;
            gap: var(--gap);
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .race-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: relative;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 8px;
            padding: 5px;
        }
        
        .race-number {
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
        }
        
        .track-logo {
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            padding: 3px;
            border-radius: 5px;
        }
        
        .track-logo img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .track-name {
            flex-grow: 1;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color:rgb(255, 255, 255);
            letter-spacing: 1px;
            padding: 0 10px;
            height: 100%;
            display: flex;
            align-items: center;
        }
        
        .race-date {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 0 10px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color:rgb(255, 255, 255);
            background-color: rgb(77, 76, 76);
            width: 100px;
        }
        
        .daytona { background-color: #333333; }
        .kansas { background-color: #3a64d8; }
        .north-wilkesboro { background-color: #f44336; }
        .watkins-glen { background-color: #00aaff; }
        .texas { background-color: #ff6347; }
        .gateway { background-color: #004c8c; }
        .talladega { background-color: #f2b600; }
        .rockingham { background-color: #555555; }
        .richmond { background-color: #3366cc; }
        .portland { background-color: #e91e63; }
        .homestead-miami { background-color: #009688; }
        .atlanta { background-color: #d32f2f; }
        
        .loading {
            text-align: center;
            font-size: 1.5rem;
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .race-number {
                font-size: 1.5rem;
                width: 40px;
            }
            
            .track-name {
                color:rgb(255, 255, 255);
                font-size: 1.2rem;
            }
            
            .race-date {
                font-size: 1.2rem;
                color:rgb(255, 255, 255);
                width: 80px;
            }
        }
        
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.2rem;
            }
            
            .race-number {
                font-size: 1.2rem;
                width: 35px;
            }
            
            .track-logo {
                width: 40px;
            }
            
            .track-name {
                color:rgb(255, 255, 255);
                font-size: 1rem;
            }
            
            .race-date {
                font-size: 1rem;
                color:rgb(255, 255, 255);
                width: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="container">
            <header>
                <h1>SOX</h1>
                <h2>S3 SCHEDULE</h2>
            </header>

            <div id="schedule-container" class="schedule-container">
                <!-- Schedule will be populated here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            
            function renderSchedule(data) {
                const container = document.getElementById('schedule-container');
                container.innerHTML = '';
                
                data.forEach(race => {
                    const card = document.createElement('div');
                    card.className = 'race-card';
                    
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

            renderSchedule(scheduleData);
        });
    </script>
</body>
</html>
