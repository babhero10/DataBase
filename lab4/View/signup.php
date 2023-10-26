<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <div class="center">
        <form action="../Controller/signup.php" method="post">
            <input type="text" name="name" class="name" placeholder="Name">
            <input type="email" name="email" class="email" placeholder="Email">
            <input type="password" name="password" class="password" placeholder="Password">
            <input type="password" name="rePassword" class="re-password" placeholder="re-password">
            <input type="submit" value="Login">
            <p> Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </div>
</body>
</html>