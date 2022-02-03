<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog - Tailsaw </title>
  <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.3/css/bulma.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bulma-divider.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

    body {
      font-family: 'Nunito', sans-serif;
    }

    ;

    nav.navbar {
      height: 6rem !important;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06) !important;
    }
  </style>
</head>

<body>
<!-- START NAV -->
<nav class="navbar">
    <div class="container">
      <div class="navbar-brand">
        <!-- <a class="navbar-item" href="../">
          <img src="../images/bulma.png" alt="Logo">
        </a> -->
        <span class="navbar-item">FacebookCFPT</span>
        <span class="navbar-burger burger" data-target="navbarMenu">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </div>
      <div id="navbarMenu" class="navbar-menu">
        <div class="navbar-end">
          <div class=" navbar-item">
            <div class="control has-icons-left">
              <input class="input is-rounded" type="email" placeholder="Search">
              <span class="icon is-left">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
          <a class="navbar-item is-active is-size-5 has-text-weight-semibold" href="index.php?page=home">
            <i class="fas fa-home"></i>
            Home
          </a>
          <a class="navbar-item is-size-5 has-text-weight-semibold" href="index.php?page=post">
            <i class="fas fa-plus"></i>
            Post
          </a>
          <a class="navbar-item is-size-5 has-text-weight-semibold">
            <i class="fas fa-user-circle"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>
  <!-- END NAV -->