<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="registerContainer">
        <div class="signIn">
            <div class="registerImage">
                <div class="registerLogo">
                    <img src="/icons/hexagon.svg" alt="">
                    <h2>Daily Update</h2>
                </div>
                <div class="registerIllustration">
                    <img src="/images/girlOnstep.png" alt="">
                </div>
            </div>
            <div class="registerFormContainer">
                <div class="registerFormTitle">
                    <h1>Log In</h1>
                </div>
                <div class="registerForm">
                    <form action="/_actions/login.php" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="email">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="password">
                        <button type="submit">Login</button>
                    </form>
                </div>    
                <div class="switchToSignIn">
                    <span>First Time Here?</span><a href="/signUp.php">Sign Up</a>
                </div>
                <div class="cancelRegister">
                    <a href="index.php"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php include ('index.php')?>
</body>
</html>
