<?php
 try{
      //error_reporting(E_USER_WARNING );
     if(isset($_COOKIE['idSessione']) && !isset($_SESSION['id'])){session_start(array("id" => $_COOKIE['idSessione'])); header("location: index.php");};
      if( isset($_POST['username']) && isset($_POST['psw'])){
         // controllo input
         $username = preg_match("/^[a-z0-9]{15,20}$/i", isset($_POST['username'])?$_POST['username']:throw new Exception("username non passato",400), $usernameR)?$_POST['username']:throw new Exception("l'username non rispecchia i carattiri specificati",400);
         $psw = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])[A-Za-z\d$@$!%*?&_]{8,12}$/", isset($_POST['psw'])?$_POST['psw']:throw new Exception("password non passata",400), $usernameR)?$_POST['psw']:throw new Exception("la password non rispecchia i carattiri specificati",400);
         
         // cerco ne db l'utente
         $pdo = new PDO("mysql:host=localhost; dbname=","root",);
         $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $trova = $pdo -> prepare("select * from users where username = ':username' and psw=':psw'");
         $trova -> bindParam($username,":username");
         $trova -> bindParam($psw,":psw");
         $trova->execute();
            if($trova->rowCount()>1){
            // echo json_encode(array("username"=>$trova->fetch(PDO::FETCH_ASSOC)["username"],"psw"=>$trova->fetch(PDO::FETCH_ASSOC)["psw"]));
            session_start(array("id"=> uniqid()));
            setcookie("id",$_SESSION["id"],time()*60*60*24);
            header("location: index.php");

         }else{
            throw new Exception("parametri non passati",400);
         }
      }
}catch(PDOException | Error $e){
   header("location: index.php; method=post; error=".$e->getMessage()."&code=".$e->getCode());
}

?>