<?php
    isset($_COOKIE['idSessione']) && !isset($_SESSION['id'])? session_start(array("id" => $_COOKIE['idSessione'])) : throw new Exception('esegui il login');
    
    $userRequest=curl_init("C:/xampp/htdocs/login.php");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
</head>
<body class="w3-container w3-teal">
    <form action="C:/xampp/htdocs/login.php" method="post"> 
        <input type="text" name="user" placeholder="Username">
        <input type="text" name="psw" placeholder="Password">
        <input type="submit" value="Invia">
    </form>
</body>
</html>
<?php 
    catch(PDOException | Error $e){
        echo $e->getMessage();
    }
?>