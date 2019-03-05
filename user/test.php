<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="quantity">
        <button type="submit" name="update" value="submit">aa</button> 

    </form>
    <?php

    if(isset($_POST['update'])){
        $quantity = $_POST['quantity'];
        echo $quantity;
    }
    ?>
</body>
</html>