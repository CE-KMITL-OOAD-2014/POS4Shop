<html>

<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/ripples.min.css" rel="stylesheet">
    <link href="/css/material-wfont.min.css" rel="stylesheet">
    @section('head')
    <title>POS4Shop - Layout</title>

    @show

</head>

<body>
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">POS4Shop</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <!-- class="active" -->
                <li ><a href="#">Menu for Dev</a></li>
                <li ><a href="product">Product</a></li>
                <li ><a href="customer">Customer</a></li>
                <li ><a href="manager">Manager</a></li>
                <li ><a href="history">History</a></li>
                <li ><a href="#">Shop</a></li>

            </ul>
            <form class="navbar-form navbar-left">
                <input class="form-control col-lg-8" placeholder="Search" type="text">
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class='container'>
    @yield('body')
    </div>

    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/js/ripples.min.js"></script>
    <script src="/js/material.min.js"></script>
</body>

</html>
