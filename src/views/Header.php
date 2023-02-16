<!DOCTYPE html>
<html lang="fr">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Court Circuit - Click&Collect</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item"><a class="nav-link" href="">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="?action=about-us">A propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="?action=shop">Boutique</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="menu-icon">
                        <a href="?action=conn_log">
                            <i class="fa fa-user"></i>
                            <p>Mon Compte</p>
                        </a>
                    </li>
                    <li class="side-menu menu-icon"><a href="#">
                        <i class="fa fa-shopping-bag"></i>

                            <?php
                                use Application\manager\CartManager;

                                CartManager::loadCart();
                                $len = count(CartManager::getCart());
                                echo "<span class='badge'>$len</span>"
                            ?>
                            <p>Mon Panier</p>
                    </a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">

                    <?php

                    CartManager::loadCart();
                    $carts = CartManager::getCart();

                    $prixTotal = 0;
                    $html = "";
                    foreach ($carts as $cart) {

                        $pr = $cart->__get('produit');
                        $qte = $cart->__get('quantite');

                        if ($pr->poids == 0) {
                            $prix = $pr->prix * ($qte / 1000);
                            $refQte = "grammes";
                            $refPrix = "/ kg";
                            $empreinte = $pr->distance * ($qte / 1000);
                        } else {
                            $prix = $pr->prix * $qte;
                            $refQte = "unité(s)";
                            $refPrix = "/ unité";
                            $empreinte = $pr->distance * $pr->poids;
                        }

                        $prixTotal += $prix;


                        $html .= "<li>";
                        // image
                        $html .= "<a href='#' class='photo'><img src='images/$pr->id.jpg' class='cart-thumb' alt='' /></a>";
                        // nom
                        $html .= "<h6><a href='#'>$pr->nom </a></h6>";
                        // prix
                        $html .= "<p>$qte $refQte - <span class='price'>$prix €</span></p>";
                        $html .= "</li>";

                    }


                    $html .= <<< HEAD
                        <li class="total">
                        <a href="?action=cart" class="btn btn-default hvr-hover btn-cart">Voir le panier</a>
                        <span class="float-right"><strong>Total</strong>: $prixTotal €</span>
                    </li>
                    HEAD;

                    echo $html;

                    ?>

                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>

<!-- Start Top Search -->
<div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
<!-- End Top Search -->