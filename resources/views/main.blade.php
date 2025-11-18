<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with landing page.">
    <meta name="author" content="Devcrud">
    <title>Foodie Resto</title>

    <!-- font icons -->
    <link rel="stylesheet" href="user/assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="user/assets/vendors/animate/animate.css">

    <!-- Bootstrap -->
	<link rel="stylesheet" href="user/assets/css/foodhut.css">
    
    <!-- Font Awesome for cart icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: bold;
        }
        .dropdown-item .badge {
            float: right;
            margin-top: 2px;
        }
        .navbar-nav .nav-item {
            position: relative;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    @if(session('booktable'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('booktable') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#gallary" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                    <div class="dropdown-menu" aria-labelledby="menuDropdown">
                        <a class="dropdown-item" href="#foods">Foods</a>
                        <a class="dropdown-item" href="#drinks">Drinks</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#book-table">Book-Table</a>
                </li>
            </ul>
            <a class="navbar-brand m-auto" href="#">
                <img src="assets/imgs/logo.svg" class="brand-img" alt="">
                <span class="brand-txt">Foodie Resto</span>
            </a>
            <ul class="navbar-nav">  
                @if (Route::has('login'))
                @auth
                @php
                    // Calculate cart counts directly in the view
                    $foodCartCount = App\Models\FoodCart::where('userID', Auth::id())->where('status', 'active')->count();
                    $drinkCartCount = App\Models\DrinkCart::where('userID', Auth::id())->where('status', 'active')->count();
                    $totalCartCount = $foodCartCount + $drinkCartCount;
                @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i> Cart
                        @if($totalCartCount > 0)
                            <span class="cart-badge">{{ $totalCartCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="cartDropdown">
                        <a class="dropdown-item" href="{{ route('food.cart') }}">
                            Food Cart 
                            @if($foodCartCount > 0)
                                <span class="badge badge-primary">{{ $foodCartCount }}</span>
                            @endif
                        </a>
                        <a class="dropdown-item" href="{{ route('drink.cart') }}">
                            Drink Cart 
                            @if($drinkCartCount > 0)
                                <span class="badge badge-info">{{ $drinkCartCount }}</span>
                            @endif
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                </li>
                @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- show cart section -->
    <div style="margin-top: 70px;" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        @yield('show_cart')
    </div>
    <div style="margin-top: 50px;" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        @yield('show_cart1')
    </div>
    
    <!-- header -->
    <header id="home" class="header">
        <div class="overlay text-white text-center">
            <h1 class="display-2 font-weight-bold my-3">Foodie Resto</h1>
            <h2 class="display-4 mb-5">Always fresh &amp; Delightful</h2>
            <a class="btn btn-lg btn-primary" href="#foods">Get Started</a>
        </div>
    </header>

    <!-- About Section -->
    <div id="about" class="container-fluid wow fadeIn" data-wow-duration="1.5s">
        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <h2 class="mb-4">About Us</h2>
                        <p>Welcome to Foodie Resto, where every meal is made with love, passion, and the freshest local ingredients.
                        We believe that good food brings people together — that's why we take pride in serving dishes that remind you of home, crafted with care and inspired by Filipino flavors.</p>
                        <p>From our signature pork adobo and crispy sisig to refreshing halo-halo desserts, every bite tells a story of tradition and taste. Whether you're dining in with family, hanging out with friends, or grabbing a quick bite, our goal is to make you feel right at home.</p>
                        <p>Come experience the warm hospitality, cozy atmosphere, and delicious food that make Foodie Resto more than just a place to eat — it's where memories are made.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Foods Section -->
    <div id="foods" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
    </div>
    <div class="gallary row">
        @yield('home')
    </div>

    <div id="drinks" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
    </div>
    <div class="gallary row">
    </div>

    <!-- Book a Table Section -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
        <div class="">
            <h2 class="section-title mb-5">BOOK A TABLE</h2>
            <form action="{{ route('book.table') }}" method="post">
                @csrf
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="email" id="booktable" name="email" class="form-control form-control-lg custom-form-control" placeholder="EMAIL" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="number" id="booktable" name="number_of_guests" class="form-control form-control-lg custom-form-control" placeholder="NUMBER OF GUESTS" max="20" min="1" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="time" id="booktable" name="time" class="form-control form-control-lg custom-form-control" placeholder="TIME" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="date" id="booktable" name="date" class="form-control form-control-lg custom-form-control" placeholder="12/12/12" required>
                    </div>
                </div>
                <div>
                    <input type="submit" name="submit" class="btn btn-lg btn-primary" id="rounded-btn" value="Find Table">
                </div>
            </form>
        </div>
    </div>

    <!-- Page Footer -->
    <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row">
            <div class="col-sm-4">
                <h3>EMAIL US</h3>
                <P class="text-muted">restaurant@gmail.com</P>
            </div>
            <div class="col-sm-4">
                <h3>CALL US</h3>
                <P class="text-muted">(62+) 9999999999</P>
            </div>
            <div class="col-sm-4">
                <h3>FIND US</h3>
                <P class="text-muted">Bohol</P>
            </div>
        </div>
    </div>
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright <script>document.write(new Date().getFullYear())</script> Foodie Resto</p>
    </div>

    <!-- Core Scripts -->
    <script src="user/assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="user/assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <script src="user/assets/vendors/bootstrap/bootstrap.affix.js"></script>
    <script src="user/assets/vendors/wow/wow.js"></script>
    <script src="user/assets/js/foodhut.js"></script>

</body>
</html>