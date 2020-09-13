<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>SkySilk example email</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <style>
            body{
    background-color: #e1e1e1;
    font-family: Arial, Helvetica, sans-serif;
}

.container{
  max-width: 680px;
  width: 100%;
  margin: auto;
}

main{
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    color: #555555; 
}

.body h2{
    font-weight: 300;
    color: #464646;
}

.logo{
    width: 150px;
    padding: 5px 5px;
}

.header-img{
    max-width: 100% !important;
    height: auto !important;
    width: 100%;
}

a{
    text-decoration: underline; 
    color: #0c99d5; 
}

.body{
    padding: 20px;
    background-color: white;
    font-family: Geneva, Tahoma, Verdana, sans-serif; 
    font-size: 16px; 
    line-height: 22px; 
    color: #555555; 
}

button{
    background-color: #0c99d5;
    border: none;
    color: white;
    border-radius: 2px;
    height: 50px;
    max-width: 250px;
   padding: 0px 30px;
    font-weight: 500;
    font-family: Geneva, Tahoma, Verdana, sans-serif; 
    font-size: 16px;
    margin: 10px 0px 30px 0px;
}

footer{
    padding-top: 50px;
    font-family: Geneva, Tahoma, Verdana, sans-serif; 
    font-size: 14px; 
    line-height: 18px; 
    color: #738597;
    text-align: center;
}

footer img{
    width: 100px;
    margin: 24px 0px;
}
        </style>
    </head>
    <body>
        <div class="container">
            <?php echo $body; ?>
        </div>
    </body>
</html>
