<?php include '../masterpages/head.php' ?>
<title>Log In</title>
<?php
include '../masterpages/logOutHeader.php';
?>

    <main class="login-main">
        <article class="login-article01">
            <h1>
                login
            </h1>
        </article>
        <article class="login-article02">
        <form class="login-form" method="POST" action="#">       
            <div class="input-div">
                <label for="title">Email</label>
                <input type="email" name="email" placeholder="  example@woodhousing.com">
            </div>
            <div class="input-div">
                <label for="password">Password</label>
                <input type="text" name="password">
            </div>           
            <div class="login-btn">
                <button type="login">LogIn</button>
            </div>
            <a href="./signUp.php">Create an account</a>
        </form>
        </article>
    </main>
    <?php include '../masterpages/footer.php' ?>