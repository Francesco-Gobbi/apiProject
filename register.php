<?php 
    try
    {
        if(isset($_POST['Ruser']) && isset($_POST['Rpsw']) && isset($_POST['Rpsw2'])){
            // controllo input
            $username = preg_match("/^[a-z0-9]{15,20}$/i", isset($_POST['Ruser'])?$_POST['Ruser']:throw new Exception("username non passato",400), $usernameR)?$_POST['Ruser']:throw new Exception("l'username non rispecchia i carattiri specificati",400);
            $psw = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&_]{8,12}$/", isset($_POST['Rpsw'])?$_POST['Rpsw']:throw new Exception("password non passata",400), $usernameR)?$_POST['Rpsw']:throw new Exception("la password non rispecchia i carattiri specificati",400);
            $psw2 = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&_]{8,12}$/", isset($_POST['Rpsw'])?$_POST['Rpsw']:throw new Exception("password non passata",400), $usernameR)?$_POST['Rpsw']:throw new Exception("la password non rispecchia i carattiri specificati",400);
            
            password_hash($psw,PASSWORD_BCRYPT);
            password_hash($psw2,PASSWORD_BCRYPT);
            password_verify($psw,$psw2);

            // cerco ne db l'utente
            $pdo = new PDO("mysql:host=localhost; dbname=","root",);
            $pdo -> exec("select username from users where username = '".$username."'");
            !isset($pdo)?: throw new Exception("username già esistente",400);
            $cerca = $pdo -> prepare("select * from users where user = username,psw = psw)");
            $cerca -> bindParam($username,":username");
            $cerca -> bindParam($psw,":psw");
            $cerca->execute();
            if($cerca->rowCount()<1){
                $pdo -> exec("insert into users (username,psw) values ('".$username."','".$psw."')");
                session_start(array("id"=> uniqid()));
                setcookie("id",$_SESSION["id"],time()*60*60*24);
                header("location: index.php");
            }else{
                throw new Exception("password gia utilizzata",400);
            }
        }
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
    <form action= "" method="post"> 
        <input type="text" name="Ruser" placeholder="Username" required>
        <input type="text" name="Rpsw" placeholder="Password" required>
        <input type="text" name="Rpsw2" placeholder="conferma Password" required>
        <div class="w3-bar">
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