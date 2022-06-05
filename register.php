<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>    
    <?php include('functions.php'); ?>    
    <?php register() ?>   
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="nama" placeholder="Nama">
        <input type="text" name="nomerTelp" placeholder="No. Telp">
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="submit" value="Register">
    </form>
</body>
</html>