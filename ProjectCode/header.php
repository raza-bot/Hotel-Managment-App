<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name=viewport content="width=device-width, intial-scale=1">
        <title>Testing Website</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <header>
        <nav class="nav-header-main">
            <!-- Logo Image -->
            <a class="header-logo" href="index.php">
                <img src="img/hotel_logo.PNG" alt="logo"> 
            </a>   
            <!-- Access buttons on top of page --> 
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.inc.php">Hotels</a></li>
                <li><a href="#">Contact</a></li> 
            </ul> 
        </nav>   
            <div class="header-login">
                <!-- Login  --> 
                <form action="login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/Email...">
                    <input type="password" name="pwd" placeholder="Password...">
                    <button type="submit" name="login-submit">Login</button>                
                </form>
                <a href="signup.php" class="header-signup">Sign Up</a>
                <!-- Logout -->
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>                
                </form>
            </div> 
       
        
        
    </header>
                                     
    </body>
</html>