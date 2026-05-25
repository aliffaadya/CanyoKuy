<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tour Guide</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #FFFFFF;
            font-family: Inter, sans-serif;
        }

        .container {
            position: relative;
            width: 1440px;
            height: 1024px;
            margin: auto;
        }

        /* Navbar */

        .navbar {
            position: absolute;
            width: 1440px;
            height: 104px;
            left: 0;
            top: 0;
            background: white;
        }

        .logo-circle {
            position: absolute;
            width: 100px;
            height: 100px;
            left: 45px;
            top: 4px;

            background: #4199CC;
            border-radius: 50%;
        }

        .logo-text {
            position: absolute;
            left: 68px;
            top: 37px;

            font-size: 24px;
            font-weight: 800;
        }

        .menu {
            position: absolute;
            top: 39px;

            display: flex;
            gap: 70px;

            left: 301px;
        }

        .menu a {
            text-decoration: none;
            color: black;

            font-size: 24px;
            font-weight: 600;
        }

        .menu a.active {
            font-weight: 800;
        }

        /* Card */

        .card {
            position: absolute;

            width: 264px;
            height: 330px;

            background: #4199CC;
        }

        .card1 {
            left: 100px;
            top: 297px;
        }

        .card2 {
            left: 428px;
            top: 297px;
        }

        .card3 {
            left: 756px;
            top: 297px;
        }

        .card4 {
            left: 1084px;
            top: 297px;
        }

        .title {
            position: absolute;

            font-size: 32px;
            font-weight: 800;
        }

        .subtitle {
            position: absolute;

            font-size: 24px;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- Navbar -->

        <div class="navbar">

            <div class="logo-circle"></div>

            <div class="logo-text">
                Logo
            </div>

            <div class="menu">
                <a href="#">Beranda</a>
                <a href="#">Paket Wisata</a>
                <a href="#">Cek Booking</a>
                <a href="#">Testimoni</a>
                <a href="#" class="active">Tour Guide</a>
            </div>

        </div>

        <!-- Card 1 -->

        <div class="card card1"></div>

        <div class="title" style="left:96px; top:628px;">
            Nama Tour Guide
        </div>

        <div class="subtitle" style="left:131px; top:667px;">
            Bidang Keahlian
        </div>

        <!-- Card 2 -->

        <div class="card card2"></div>

        <div class="title" style="left:424px; top:627px;">
            Nama Tour Guide
        </div>

        <div class="subtitle" style="left:467px; top:667px;">
            Bidang Keahlian
        </div>

        <!-- Card 3 -->

        <div class="card card3"></div>

        <!-- Card 4 -->

        <div class="card card4"></div>

    </div>

</body>

</html>