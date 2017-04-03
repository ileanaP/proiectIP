@extends('layouts.form')
@section('content')

<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login to our site</h3>
                            <p>Enter your username and password to log on:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="login" method="post" class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password..." class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" class="btn">Sign in!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="../resources/assetsLogin/js/jquery-1.11.1.min.js"></script>
<script src="../resources/assetsLogin/bootstrap/js/bootstrap.min.js"></script>
<script src="../resources/assetsLogin/js/jquery.backstretch.min.js"></script>
<script src="../resources/assetsLogin/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="../resources/assetsLogin/js/placeholder.js"></script>
<![endif]-->

@stop