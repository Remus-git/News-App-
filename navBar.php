<nav>
            <div class="navBar">
                <div class="logo">
                    <img src="/icons/hexagon.svg" alt="">
                    <h1>Daily Update</h1>
                </div>
                <div class="menu">
                    <div class="expend">
                        <img src="/icons/chevron-right.svg" alt="" id="chevronRight">
                        <img src="/icons/chevron-left .svg" alt="" id="chevronLeft">
                        
                        <h1>Back</h1>
                    </div>
                    <div class="user">
                        <a href="/profile.php"><img src="/icons/user.svg" alt=""></a>
                        <h1>Profile</h1>
                    </div>
                    <div class="home">
                        <a href="index.php"><img src="/icons/home.svg" alt=""></a>
                        <h1>Home</h1>
                    </div>
                    <div class="favourite">
                        <a href="#"><img src="/icons/star.svg" alt=""></a>
                        <h1>Favourite</h1>
                    </div>
                    <div class="help">
                        <a href="#"><img src="/icons/help-circle.svg" alt=""></a>
                        <h1>Help</h1>
                    </div>
                    <?php if(isset($_SESSION['user'])) : ?>
                        <div class="logout">
                            <a href="_actions/logout.php"><img src="/icons/log-out.svg" alt=""></a>
                            <h1>Logout</h1>
                        </div>
                    <?php endif ?>    
                </div>
            </div>
    </nav>