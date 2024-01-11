<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Shopping Cart</title>
</head>
<body>
{{-- Begin navbar --}}
<nav class="navbar">
    <div class="logo"><a href="/products"><span>Portfolio</span></a></div>
    <hr>
    <ul class="menu">
        @if (Auth::user())
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
</nav>
{{-- End navbar --}}
@if (Session::has('cart'))
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Quantity</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            @foreach($products as $product)
                <th scope="row">{{$product['qty']}}</th>
                <td><strong>{{ $product['item'] ['name']  }}</strong></td>
                <td><span class="label label-succes">€{{ $product['price'] }}</span></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                               href="{{ route('product.reduceByOne', ['id'=> $product['item']]['id']) }}">Reduce by
                                1</a>
                            <a class="dropdown-item"
                               href="{{ route('product.addByOne', ['id'=> $product['item']]['id']) }}">Add
                                by 1</a>
                            <a class="dropdown-item"
                               href="{{ route('product.remove', ['id'=> $product['item']]['id']) }}">Reduce all</a>
                        </div>
                    </div>
                </td>
        </tr>
        </tbody>
        @endforeach
    </table>


    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: €{{ $totalPrice }}</strong>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <a href="{{ route('checkout') }}" type="button" class="btn btn-success" style="color: #fff;">Checkout</a>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <h3>There are no items in the Cart!</h3>
        </div>
    </div>
@endif

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>