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
        <div class="register">
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
                    <h1>Create Your Account</h1>
                </div>
                <div class="registerForm">
                    <form action="/_actions/create.php" method="post">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="name" id="name" required>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="email" required>
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="phone">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="password" required>
                        <button type="submit">Create</button>
                    </form>
                </div>    
                <div class="switchToSignIn">
                    <span>Already Have An Account?</span><a href="/signIn.php">Sign In</a>
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
