<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <!-- MAIN CSS-->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/main.css') }}">
    <!--my responsive-->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">
    <!--- FONT AWESOME -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/meanmenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/nice-select.css') }}">
    <!--- awl carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>@yield('title')</title>
    @stack('css')
</head>

<body style="background: rgb(209, 235, 241)">
    <!-- Header Area -->
    <div class="header-section">
        <div class="container position-relative">
            <div class="row">
                <div class="col-xl-5 col-md-12 my-xl-5 mb-0 my-sm-3  position-static ">
                    <div class="main-menu d-none d-md-block">
                        <nav>
                            <ul>
                                <li><a href="{{ route('frontend.index') }}">Home</a>
                                </li>
                                <li><a href="{{ route('frontend.shop') }}">Shop</a>
                                </li>
                                <li><a href="#">Feature <i class="fas fa-angle-down"></i></a></li>
                                <li><a href="#">Blogs</a>
                                    <div class="mega-menu">
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="position-static"><a href="#">About Us</a>
                                    <div class="mega-menu mega-full">
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                        <ul>
                                            <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                            <li><a href="#">Mega menu Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-menu d-md-none">
                        <nav id="mobile-menu-active">
                            <ul>
                                <li><a href="#">Home <i class="fas fa-angle-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="#">Submenu item 1</a></li>
                                        <li><a href="#">Submenu item 1</a></li>
                                        <li><a href="#">Submenu item 1</a></li>
                                        <li><a href="#">Submenu item 1</a></li>
                                        <li><a href="#">Submenu item 1</a>
                                            <ul class="submenu">
                                                <li><a href="#">Submenu item 1</a></li>
                                                <li><a href="#">Submenu item 1</a></li>
                                                <li><a href="#">Submenu item 1</a></li>
                                                <li><a href="#">Submenu item 1</a></li>
                                                <li><a href="#">Submenu item 1</a>
                                                    <ul class="submenu">
                                                        <li><a href="#">Submenu item 1</a></li>
                                                        <li><a href="#">Submenu item 1</a></li>
                                                        <li><a href="#">Submenu item 1</a></li>
                                                        <li><a href="#">Submenu item 1</a></li>
                                                        <li><a href="#">Submenu item 1</a> </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Blogs</a>
                                    <ul class="mega-menu">
                                        <li class="mega-title"><a href="#">Mega menu Tilte</a></li>
                                        <li><a href="#">Mega menu Item</a></li>
                                        <li><a href="#">Mega menu Item</a></li>
                                        <li><a href="#">Mega menu Item</a></li>
                                        <li><a href="#">Mega menu Item</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Submenu item 1</a> </li>
                                <li><a href="#">Submenu item 1</a> </li>
                                <li><a href="#">Submenu item 1</a> </li>
                                <li><a href="#">Submenu item 1</a> </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-12 text-center mb-0  my-xl-5 ">
                    <div class="">
                        <a href="index.html" class="text-center"><img width="175" height="45" src="{{ asset('public/frontend/img/logo.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-8 col-sm-12 mb-0  my-xl-5 text-center text-md-right position-relative">
                    <div class="header-right">
                        <ul>
                            @if (Session::get('customer_id'))
                                <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                @else
                                <li><a href={{ route('checkout_form') }}>Login</a></li>
                            @endif
                            <li><a href="#"><i class="fas fa-heart"></i> (0)</a></li>
                            <li><a href="#">cart({{ $totalQuantity }})</a>
                                  <div class="card-hover p-3">
                                        <table class="table table-dark table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="h-100">image</th>
                                                            <th>name</th>
                                                            <th>price</th>
                                                            <th>Action</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>

                                                        @foreach ($cartGetContents as $cart)
                                                        <tr>
                                                        <td> <img style="width:100%;height:65px" src="{{ asset('public/storage/product/'.$cart->attributes->product_image) }}"  alt=""></td>
                                                        <td> <p>{{ $cart->name }}</p></td>
                                                        <td>TK {{ $cart->price }}<br>
                                                       total: TK {{ $cart->price*$cart->quantity }}
                                                        </td>
                                                        <td  class="position-relative">
                                                            <a  class="d-inline position-absolute" href="{{ route('cart_product_remove',$cart->id) }}" style="top:-23px;right:13px;"><i class="fas fa-trash-alt text-danger"></i></a>
                                                            <form action="{{ route('cart_product_update') }}" method="post" class="mt-4">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input class="w-100 form-control" type="number" value="{{ $cart->quantity }}" min="1" name="product_quantity">
                                                                    <input class="w-100" type="hidden" value="{{ $cart->id }}" name="product_id">

                                                                    <label for="my-input">
                                                                        <button type="submit" class="btn btn-outline-light mt-1">Update</button>
                                                                    </label>
                                                                </div>

                                                            </form>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                </tbody>

                                            </table>
                                    <div class="total-price clearfix">
                                        <span class="float-left total-left">Total:</span>
                                        <span class="float-right total-right">TK {{ $totalPrice }}</span>
                                        @php
                                            Session::put(['totalPrice'=>$totalPrice])
                                        @endphp
                                    </div>
                                    <a href="{{ route('checkout_form') }}" class="check-out-botton">Check out</a>

                                </div>

                            </li>
                            <li><a href="#"><i class="fas fa-search"></i></a>
                                <div class="search-box">
                                    <form action="#">
                                        <input type="text" placeholder="Search">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
