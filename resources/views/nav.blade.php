<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <style>
        body, h1 { font-family: "Raleway", sans-serif }
        .w3-bar-block .w3-bar-item { padding: 20px }
    </style>
</head>

<body class="w3-light-grey">

<div class="w3-bar w3-hide-large w3-white w3-xlarge">
    <button class="w3-bar-item w3-button w3-padding-16" onclick="openSidebar()">☰ Meni</button>
</div>

<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;" id="mySidebar">
    <a href="{{ route('pocetna') }}" class="w3-bar-item w3-button">Početna</a>
    <a href="{{ route('katalog') }}" class="w3-bar-item w3-button">Katalog</a>
    <a href="{{ route('kontakt') }}" class="w3-bar-item w3-button">Kontakt</a>
</nav>

<div class="w3-overlay w3-hide-large" onclick="closeSidebar()" style="cursor:pointer" id="myOverlay"></div>

<div class="w3-main" style="margin-left:300px">
    <header class="w3-container w3-xlarge">
        <div class="w3-padding-16">
            <a href="{{ route('pocetna') }}" class="w3-bar-item w3-button w3-border-bottom w3-large">
                <img src="{{ asset('images/logo.png') }}" style="width:50px" alt="Logo">
                Moda Shop
            </a>
            <span class="w3-right">
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf
                        <button class="w3-button">Odjava</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w3-button">Prijava</a>
                    <a href="{{ route('register') }}" class="w3-button">Registracija</a>
                @endauth
            </span>
        </div>
    </header>

    <div class="w3-display-container w3-container">
        <img src="{{ asset('images/jeans.jpg') }}" alt="Jeans" style="width:100%">
        <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
            <h1 class="w3-jumbo w3-hide-small">Dobro došli!</h1>
            <h1 class="w3-hide-large w3-hide-medium">Nova kolekcija</h1>
            <h1 class="w3-hide-small">Nova kolekcija</h1>
            <p><a href="{{ route('katalog') }}" class="w3-button w3-black w3-padding-large w3-large">KUPI ODMAH</a></p>
        </div>
    </div>

    <div class="w3-container w3-padding">
        @yield('sadrzaj')
    </div>
</div>

<script>
function openSidebar() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function closeSidebar() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
