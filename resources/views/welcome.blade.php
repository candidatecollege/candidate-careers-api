<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Candidate College API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" href="https://i.postimg.cc/vZMVCm7g/LOGO-CC.png">

    <style>
        body {
            position: fixed;
            top: 50%;
            left: 50%;
            font-family: 'Plus Jakarta Sans', 'sans-serif';
            transform: translate(-50%, -50%);
            background-color: #1B4E6B;

        }

        .item {
            display: flex;
            width: 100%;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        img {
            width: 10rem;
            height: 10rem;
            margin: 0 auto 1rem auto;
            text-align: center;
        }

        p.heading {
            font-size: 2rem;
            margin-top: 0;
            text-align: center;
            color: #FFF;
        }

        p.desc {
            color: #90A3BF;
            margin-top: -1rem;
            text-align: center;
        }
    </style>

</head>

<body class="antialiased">
    <section class="item">
        <img src="https://i.postimg.cc/vZMVCm7g/LOGO-CC.png" title="Candidate College Logo" alt="Candidate College Logo" />
        <p class="heading">Candidate College Careers API</p>
        <p class="desc">Resource for Candidate College's Developer in Developing the Career Feature!</p>
    </section>
</body>

</html>