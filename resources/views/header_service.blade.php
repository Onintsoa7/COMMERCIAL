<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vente</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css')}}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/templatemo-pod-talk.css')}}">

    <link rel="stylesheet" href="{{ asset('css/login.css')}}">

</head>

<body>

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand me-lg-5 me-0" href="index.html">
                    <img src="images/pod-talk-logo.png" class="logo-image img-fluid" alt="MOM">
                </a>    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html">Liste Demande</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#foot">Contact</a>
                        </li>
                    </ul>
                    <div class="ms-4">
                        @if(session('id_user') == null)
                        <a href="/login" class="btn custom-btn custom-border-btn smoothscroll">Se connecter</a>
                        @else
                        <a href="/disconnect" class="btn custom-btn custom-border-btn smoothscroll">Se deconnecter</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>