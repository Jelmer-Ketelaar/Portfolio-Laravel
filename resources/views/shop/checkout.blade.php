<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- library validate -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <script src="https://js.stripe.com/v3/"></script>



    <title>Checkout Page</title>
</head>
<body>
<nav class="navbar">
    <div class="logo"><a href="/products"><span>Portfolio</span></a></div>
    <hr>
</nav>

@if (Session::has('cart'))
    <div class="row">
        <div class="col-75">
            <div class="container">
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                            @endif
                        </div>
                        <form action="{{ route('checkout.post') }}"
                              data-key="{{ env('STRIPE_PUB_KEY') }}" data-cc-on-file="false"
                              method="POST" id="checkout-form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-50">
                                    <h3>Billing Address</h3>
                                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                    <input type="text" id="fname" name="name" placeholder="Jelmer Ketelaar" required>
                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                    <input type="text" id="email" name="email" placeholder="jelmer@ketelaar.me"
                                           required>
                                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                    <input type="text" id="adr" name="address" placeholder="De Omloop 189" required>
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city" placeholder="Elshout" required>

                                    <div class="row">
                                        <div class="col-50">
                                            <label for="state">State</label>
                                            <input type="text" id="state" name="state" placeholder="Noord-Brabant"
                                                   required>
                                        </div>
                                        <div class="col-50">
                                            <label for="zip">Zip</label>
                                            <input type="text" id="zip" name="zip" placeholder="5154 BD" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-50">
                                    <h3>Payment</h3>
                                    <label for="fname">Accepted Cards</label>
                                    <div class="icon-container">
                                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                                    </div>

                                    <label for="cname">Name on Card</label>
                                    <input type="text" id="cname" name="cardname" placeholder="Jelmer Ketelaar"
                                           required>
                                    <label for="ccnum">Credit card number</label>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"
                                           required>
                                    <label for="expmonth">Exp Month</label>
                                    <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="expyear">Exp Year</label>
                                            <input type="text" id="expyear" name="expyear" placeholder="03/2023"
                                                   required>
                                        </div>
                                        <div class="col-50">
                                            <label for="cvv">CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="055" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Continue to checkout" class="btn">
                        </form>
                </div>
            </div>

            <div class="col-25">
                <div class="container">
                    <h4>Cart</h4>
                    @foreach($products as $product)
                        <p> {{$product['qty']}}x
                            <a href="#" class="inActiveLink">{{$product['item']['name']}}</a>
                            <span class="price">€{{$product['price']}}</span>
                        </p>
                    @endforeach
                    <hr>
                    <p>Total <span class="price" style="color:black">
                        <b>€{{ $totalPrice }}</b>
                    </span>
                    </p>

                </div>
            </div>
        </div>

        @else
            <div class="container"><h1>There are no items in your cart!</h1></div>
        @endif
        <script src="https://js.stripe.com/v3/"></script>

</body>