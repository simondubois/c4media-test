<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>C4Media - @yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://c4media.se/" class="simple-text">
                    C4Media
                </a>
            </div>

            <ul class="nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="/">
                        <i class="fa fa-fw fa-list-alt"></i>
                        <p>Product list</p>
                    </a>
                </li>
                <li class="{{ Request::is('cart') ? 'active' : '' }}">
                    <a href="/cart">
                        <i class="fa fa-fw fa-shopping-cart"></i>
                        <p>Shopping cart</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">@yield('title')</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <cartwidget></cartwidget>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
        </div>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/front.js" type="text/javascript"></script>
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    @yield('script')
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

</html>
