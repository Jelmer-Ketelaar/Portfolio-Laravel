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

    <title>Checkout Page</title>
</head>
<body>
@if (Session::has('cart'))
    <div>
        <h1 style="position: relative; left: 8vw">Checkout</h1>
        <hr>
        <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
            <div class="row">
                <div class="col-50">
                    <h3>Billing Address</h3>
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                    <label for="city"><i class="fa fa-institution"></i> City</label>
                    <input type="text" id="city" name="city" placeholder="New York">

                    <div class="row">
                        <div class="col-50">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" placeholder="NY">
                        </div>
                        <div class="col-50">
                            <label for="zip">Zip</label>
                            <input type="text" id="zip" name="zip" placeholder="10001">
                        </div>
                    </div>
                </div>

                <div class="col-20">
                    <h3>Payment</h3>
                    <label for="fname">Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                    <label for="ccnum">Credit card number</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                    <label for="expmonth">Exp Month</label>
                    <input type="text" id="expmonth" name="expmonth" placeholder="September">

                    <div class="row">
                        <div class="col-50">
                            <label for="expyear">Exp Year</label>
                            <input type="text" id="expyear" name="expyear" placeholder="2018">
                        </div>
                        <div class="col-50">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="352">
                        </div>
                    </div>
                </div>

            </div>
            <label>
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as
                billing
            </label>
            <button type="submit"
                    style="width: 10vw; display: block; margin-left: auto; margin-right:auto; background-color: green; color: white; "
                    value="submit" class="btn"> Continue to checkout
            </button>
        </form>
    </div>


    <div class="col-25">
        <div class="container">
            <h4>Cart</h4>
            @foreach($products as $product)
                <p> {{ $product['item']['name'] }}
                    <span class="price">€{{ $product['price'] }} </span>
                </p>
            @endforeach
            <hr>
            <p>Your total:
                <span class="price" style="color:black">
                <b>€{{ $totalPrice }}</b>
            </span>
            </p>
        </div>
    </div>
@else <h1>No items</h1>
@endif
</body>