<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome
        <?php
        if(isset($_POST["name"])) {
            echo $_POST['name'];
        }
        ?>
    </h1>
</body>
</html>