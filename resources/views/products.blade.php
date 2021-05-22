<html lang="en" xmlns:wire="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products Page | Personal Portfolio Website</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"></link>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"></link>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</head>
<body>

<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<div class="scroll-up-btn">
    <i class="fas fa-angle-up"></i>
</div>
<div class="scroll-up-btn">
    <i class="fas fa-angle-up"></i>
</div>
<nav class="navbar">
    <div class="max-width">
        <div class="logo"><a href="/">Portfo<span>lio.</span></a></div>
        <ul class="menu">
            <li><a href="#home" class="menu-btn">Home</a></li>
            <li class="cart"><a href="#products" class="menu-btn">Products</a></li>
            <li class="cart"><a href="{{ route('cart') }}" class="menu-btn">Cart</a></li>
            <li><a href=""></a></li>
            <li class="register"><a class="button" href="{{ route('register') }}">Register</a></li>
            <li class="login"><a href="{{ route('login') }}" class="menu-btn">Login</a></li>
        </ul>
        <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>
<!-- home section start -->
<section class="home" id="home">
    <div class="max-width">
        <div class="row">
            <div class="home-content">
                <div class="text-1">Welcome. This is my</div>
                <div class="text-2">Products Page</div>
                <div class="text-3">I'm a <span class="typing"></span></div>
            </div>
        </div>
    </div>
</section>

<div class="products" id="products">>
    <div class="container">
        <h1 class="lg-title">What I offer</h1>
        <p class="text-light">I offer different types of projects. It could be a website like mine. Or something
            else.
            On this page I have
            a number of projects that I offer. I hope you can find what you are looking for.
            If you can't find it, send me an email and I'll get back to you as soon as possible</p>
        <div class="product-items">
        @foreach ($products as $product)
            <!-- single product -->
                <div class="product">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="{{$product->photo}}" class="html" alt="product image">
                        </div>
                        <div class="product-btns">
                            <form action="">
                                <button type="button" class="btn-cart"> Add to cart
                                    <span><i class="fas fa-plus" style="outline: none;"></i></span>
                                </button>
                                <button wire:click="addToCart({{ $product->id }})" type="button" class="btn-buy"> buy
                                    now
                                    <span><i class="fas fa-shopping-cart"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="product-info">
                        <div id="contact-button">
                            <p class="product-name">
                                {{ $product->name }}
                            </p>
                            <p class="product-price">€ {{ $product->price }}</p>
                        </div>

                        <p class="product_description">{{ $product->description }}</p>
                    </div>
                </div>

                <!-- end of single product -->
            @endforeach
        </div>
    </div>
</div>
<!-- footer section start -->
<footer>
    <span>Created By <span class="name"> Jelmer Ketelaar</span> | <span class="far fa-copyright"></span> 2021 All rights reserved.</span>
</footer>

<script src="/js/script-products.js"></script>
@routes
<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
