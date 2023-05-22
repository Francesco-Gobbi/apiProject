<?php 
try{
    //error_reporting(E_USER_WARNING );
    !isset($_POST["error"]) ?: throw new Exception($_POST["error"] ,$_POST["code"]);
    (isset($_COOKIE['idSessione']) && !isset($_SESSION['id']))? session_start(array("id" => $_COOKIE['idSessione'])) : null;

    ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Login</title>
</head>
<p><?php echo isset($_SESSION['id'])? 'Benvenuto' : '<a href="login.php">Accedi</a>'?></p>
<body class="w3-container w3-teal">
    <form action= "logion.php" method="post"> 
        <input type="text" name="user" placeholder="Username" required>
        <input type="text" name="psw" placeholder="Password" required>
        <div class="w3-bar ">
            <input type="submit" value="Invia" class="w3-button w3-white w3-border w3-border-teal" >
            <a href="register.php" class="w3-button w3-white w3-border w3-border-red">Registrati</a>
        </div>
    </form>
    <?php 
    }catch(PDOException | Error $e){
        echo "<p class='w3-panel w3-yellow w3-card-4'>". $e->getMessage()."</p>";
    }
?>
</body>
</html>
