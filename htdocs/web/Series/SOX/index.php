<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOXS Racing League</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #1c1c1c;
      color: #fff;
      line-height: 1.6;
    }

    header {
      background-color: #333;
      padding: 2rem 0;
      text-align: center;
      border-bottom: 3px solid #f1c40f;
    }

    header .logo h1 {
      font-family: 'Impact', sans-serif;
      color: #f1c40f;
      font-size: 3rem;
      text-transform: uppercase;
    }

    nav {
      margin-top: 1rem;
    }

    nav ul {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
    }

    nav ul li {
      margin: 0 1rem;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #f1c40f;
      text-decoration: underline;
    }

    nav ul li a.active {
      font-weight: bold;
      border-bottom: 3px solid #f1c40f;
    }

    main {
      padding: 2rem;
    }

    #hero {
      text-align: center;
      background-color: #f1c40f;
      color: #333;
      padding: 3rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    #hero h2 {
      font-size: 2.5rem;
      font-weight: 700;
      text-transform: uppercase;
    }

    #hero p {
      font-size: 1.2rem;
      margin-top: 1rem;
    }

    #schedule, #results, #standings, #forum {
      margin-top: 2rem;
    }

    .race {
      margin-bottom: 1rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    table th, table td {
      padding: 1rem;
      text-align: center;
      border: 1px solid #444;
    }

    table th {
      background-color: #333;
      color: #f1c40f;
      font-weight: bold;
    }

    table tr:nth-child(even) {
      background-color: #444;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 1.5rem 0;
      margin-top: 3rem;
      font-size: 1rem;
    }

    footer a {
      color: #f1c40f;
      text-decoration: none;
      font-weight: bold;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      nav ul {
        flex-direction: column;
        align-items: center;
      }

      nav ul li {
        margin: 0.5rem 0;
      }

      #hero {
        padding: 1.5rem;
      }

      main {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <h1>SOXS Racing League</h1>
    </div>
    <nav>
      <ul>
        <li><a href="/web/API/Schedule/Series/SOX/schedule.php" id="schedule-link">Schedule</a></li>
        <li><a href="/web/racestats.php" id="results-link">Results</a></li>
        <li><a href="" id="standings-link">Standings</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="hero">
      <h2>Welcome to SOXS Racing!</h2>
      <p>Join the most exciting NR2003 league. Race with us, and be part of the action!</p>
    </section>

    <section id="forum">
      <h3>League Forum</h3>
      <p>Join our <a href="https://discord.gg/kWfskpR8xC" target="_blank">Discord</a> to discuss upcoming races and league news!</p>
    </section>
  </main>

  <script>
    const links = document.querySelectorAll('nav ul li a');
    links.forEach(link => {
      link.addEventListener('click', () => {
        links.forEach(link => link.classList.remove('active'));
        link.classList.add('active');
      });
    });
  </script>
</body>
</html>
