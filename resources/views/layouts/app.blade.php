<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'AnonMsg - Messagerie Anonyme')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa; /* Couleur claire agréable */
      color: #212529;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar custom */
    nav.navbar {
      background-color: #0069d9; /* Bleu bootstrap primaire un peu plus vif */
      font-size: 1.2rem;
    }

    nav.navbar .navbar-brand {
      font-weight: 700;
      color: #fff;
    }

    nav.navbar .navbar-brand:hover {
      color: #d1e7ff;
    }

    nav.navbar .nav-link {
      color: #f0f0f0;
      position: relative;
    }

    nav.navbar .nav-link:hover,
    nav.navbar .nav-link.active {
      color: #ffd43b; /* Jaune doré pour survol et actif */
    }

    nav.navbar .nav-link.active::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: #ffd43b;
      border-radius: 3px 3px 0 0;
    }

    /* Dropdown bouton */
    .btn-outline-light {
      color: #fff;
      border-color: #fff;
    }
    .btn-outline-light:hover {
      color: #0069d9;
      background-color: #ffd43b;
      border-color: #ffd43b;
      font-weight: 600;
    }

    /* Footer */
    footer {
      background-color: #0069d9;
      color: #e9ecef;
      padding: 2rem 1rem;
      margin-top: auto;
    }

    footer h5 {
      color: #ffd43b;
      text-transform: uppercase;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    footer a {
      color: #e9ecef;
      text-decoration: none;
    }

    footer a:hover {
      color: #ffd43b;
    }

    .social-links .btn {
      border-color: #ffd43b;
      color: #ffd43b;
    }

    .social-links .btn:hover {
      background-color: #ffd43b;
      color: #0069d9;
    }

    .footer-legal {
      border-top: 1px solid #a6c8ff;
      margin-top: 2rem;
      padding-top: 1rem;
      font-size: 0.9rem;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark px-4">
  <a class="navbar-brand" href="{{ route('dashboard') }}">AnonMsg</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav mb-2 mb-lg-0">
      @auth
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <!-- Ajoute ici d'autres liens si besoin -->
      @endauth
      @guest
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Inscription</a>
        </li>
      @endguest
    </ul>
  </div>

 <div class="d-flex align-items-center ms-auto gap-3">
  @auth
    <span class="text-white">
      <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->username }}
    </span>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline-light">
        Déconnexion
      </button>
    </form>
  @endauth
</div>

</nav>

<!-- CONTENU PRINCIPAL -->
<main class="flex-grow-1 py-4 container">
  @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-4 mb-3">
        <h5>À propos</h5>
        <p>AnonMsg vous permet de recevoir des messages anonymes en toute simplicité.</p>
      </div>
      <div class="col-md-4 mb-3">
        <h5>Contactez-nous</h5>
        <ul class="list-unstyled">
          <li><i class="fas fa-envelope me-2"></i>sarrsambou03@gmail.com</li>
          <li><i class="fas fa-phone me-2"></i>+221 77 247 61 60</li>
        </ul>
      </div>
      <div class="col-md-4 mb-3">
        <h5>Réseaux sociaux</h5>
        <div class="social-links">
          <a href="#" class="btn btn-outline-light rounded-circle me-2" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="btn btn-outline-light rounded-circle me-2" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="btn btn-outline-light rounded-circle" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-legal mt-4">
      &copy; {{ date('Y') }} AnonMsg — Tous droits réservés. Conçu par Sambou Sarr.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
