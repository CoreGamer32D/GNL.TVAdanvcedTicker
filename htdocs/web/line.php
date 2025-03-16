<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Standings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            text-align: center;
        }
        .results-grid {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 20px;
        }
        .column {
            display: flex;
            flex-direction: column;
            background-color: #222;
            padding: 10px;
            border-radius: 8px;
            min-width: 250px;
        }
        .driver-row {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            border-bottom: 1px solid #444;
        }
        .pos-cell {
            width: 40px;
        }
        .number-cell {
            width: 50px;
            font-weight: bold;
        }
        .name-cell {
            flex-grow: 1;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Live Standings</h2>
<div class="results-grid">
    <div class="column" id="left-column"></div>
    <div class="column" id="right-column"></div>
</div>

<script>
function updateStandings() {
    fetch('LINEUP.php')
        .then(response => response.json())
        .then(data => {
            let leftColumn = '';
            let rightColumn = '';
            const halfSize = Math.ceil(data.length / 2);

            data.forEach((driver, index) => {
                const rowHTML = `
                    <div class="driver-row">
                        <div class="pos-cell">${driver.position}</div>
                        <div class="number-cell">${driver.number}</div>
                        <div class="name-cell">${driver.name}</div>
                    </div>
                `;
                if (index < halfSize) {
                    leftColumn += rowHTML;
                } else {
                    rightColumn += rowHTML;
                }
            });

            document.getElementById('left-column').innerHTML = leftColumn;
            document.getElementById('right-column').innerHTML = rightColumn;
        })
        .catch(error => console.error('Error fetching standings:', error));
}

setInterval(updateStandings, 3000); // Update every 3 seconds
window.onload = updateStandings;
</script>

</body>
</html>
