<!DOCTYPE html>
<html>

    <head>
        <title>[Admin] SkySilk Example</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    [Admin] SkySilk Example
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://github.com/m1alex/sky_example">See sources</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/auth/logout">Logout</a></li>
                </ul>
            </div>
        </nav>
        
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="/admin/dashboard">
                                    <span data-feather="home"></span>
                                    Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/profile">
                                    <span data-feather="file"></span>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file"></span>
                                    Other category 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file"></span>
                                    Other category 2
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file"></span>
                                    Other category 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file"></span>
                                    Other category 4
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <?php echo $body; ?>
                </main>
            </div>
        </div>
    </body>
</html>
