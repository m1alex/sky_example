<!DOCTYPE html>
<html>
    <head>
        <title>SkySilk Example</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body> <!-- style="background: #475d62 url(https://epicbootstrap.com/freebies/snippets/login-form-dark/assets/img/star-sky.jpg);" -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    Main page
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/auth/forgot-password-form">Forgot password?</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/auth/login-form">Log in</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/auth/register-form">Create an account</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://github.com/m1alex/sky_example">See sources</a></li>
                </ul>
            </div>
        </nav>
        
        <div class="container">
            <?php echo $body; ?>
        </div>
    </body>
</html>
