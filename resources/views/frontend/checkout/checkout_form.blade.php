@extends('layouts.frontend-layout')

@section('title','Eshop | Checkout')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-5">
                @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <ul>
                     <li>{{ $error }}</li>
                </ul>
                @endforeach
            </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Resister, if you are not Register betore!
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.save') }}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" class="form-control" type="text" name="first_name"
                                    value="" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" class="form-control" type="text" name="last_name"
                                    value="" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" class="form-control" type="email" name="email"
                                    value="" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="phone"> Phone Number</label>
                                <input id="phone" class="form-control" type="text" name="phone"
                                    value="" placeholder="Enter Your Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password"
                                    value="" placeholder="Enter Your Password">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" cols="30"
                                    rows="2" placeholder="Enter Your full address "></textarea>
                            </div>
                            <input class="btn btn-info btn-lg btn-block" type="submit" value="Resister">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                <div class="alert alert-danger" role="alert">
                    {{ session('wrong_info') }}
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
                <div class="card">
                    <div class="card-header">
                       Already Registered? Login here!
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.login') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" class="form-control" type="text" name="email"
                                    value="" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password"
                                    value="" placeholder="Enter Your Password">
                            </div>

                            <input class="btn btn-info btn-lg btn-block" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
