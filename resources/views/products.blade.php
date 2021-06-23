<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products Page | Personal Portfolio Website</title>

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/products.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</head>
<body>
{{--{{$hasCart = Session::has('cart')}}--}}
{{--{{$getCart = Session::get('cart')}}--}}

<div class="scroll-up-btn">
    <i class="fas fa-angle-up"></i>
</div>
<nav class="navbar">
    <div class="max-width">
        <div class="logo"><a href="/">Portfo<span>lio.</span></a></div>
        <ul class="menu">
            @if (Auth::user())
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li class="cart"><a href="#products" class="menu-btn">Products</a></li>
                <li class="cart">
                    <a href="{{ route('shop.cart') }}"
                       class="menu-btn">Cart
                        <span>{{ Session::has('cart') ? Session::get('cart')->totalQty : ''   }}</span>
                    </a>
                </li>
                <li class="logout"><a href="{{ url('/logout') }}" class="menu-btn">Logout</a></li>
            @else
                <div class="dropdown">
                    <a class="dropbtn">User account
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            @endif
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
@if (Session::has('succes'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="succes-message" class="alert alert-succes">
                {{ Session::get('succes') }}
            </div>
        </div>
    </div>
@endif
<div class="products" id="products">
    <div class="container">
        <h1 class="lg-title">What I offer</h1>
        <p class="text-light">I offer different types of projects. It could be a website like mine. Or something
            else.
            On this page I have
            a number of projects that I offer. I hope you can find what you are looking for.
            If you can't find it, send me an email and I'll get back to you as soon as possible</p>
        <br>
        <form action="{{ route('categories') }}" method="POST">
            @csrf
            <div class="custom-select" style="width:200px;">
                <select name="categories">
                    @foreach(App\Models\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <button type="submit">Submit</button>
            </div>
        </form>
        <div class="product-items">
{{--        {{ dd($products) }}--}}
        @foreach($products as $product)
            <!-- single product -->
                <div class="product">
                    <div class="product-content">
                        <div class="product-img">
                            <img src="{{$product->photo}}" class="html" alt="product image">
                        </div>
                        <div class="product-btns">
                            <form action="">
                                <a href="{{route('product.addToCart', ['id' => $product->id]) }}" type="button"
                                   class="btn-cart"> Add to cart
                                    <span><i class="fas fa-plus"></i></span>
                                </a>
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
                        <button type="button" class="btn btn-information m-2" data-toggle="modal"
                                data-target="#demoModal{{$product->id}}">
                            Information
                        </button>
                        <p class="product_description">{{ $product->description }}</p>
                    </div>
                </div>

                <!-- end of single product -->
                <!-- Modal Example Start-->
                <div class="modal fade" id="demoModal{{$product->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="demoModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="demoModalLabel">{{$product->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $product->description }}</p>
                                <p>€{{ $product->price }}</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Example End-->
            @endforeach
        </div>
    </div>
</div>
<!-- footer section start -->
<footer>
    <span>Created By <span class="name"> Jelmer Ketelaar</span> | <span class="far fa-copyright"></span> 2021 All rights reserved.</span>
</footer>

<script src="{{ asset('js/script-products.js') }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
