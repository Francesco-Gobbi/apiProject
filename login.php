<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header("Content-Type: application/json; charset=UTF-8");
    header("Referer: http://localhost/coockie.php");

    
    $pdo = new PDO('mysql:host=localhost; dbname = cookie','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $search= $pdo->prepare("START TRANSACTION;
	                SELECT * FROM `users` WHERE username=':user' and psw=':psw'");
    $search->bindValue(':user',$_POST['user'],PDO::PARAM_STR);
    $search->bindValue(':psw',$_POST['psw'],PDO::PARAM_STR);
    $search->execute();
    switch($search->fetchAll(PDO::FETCH_ASSOC)<=>1){
        case -1:
            echo json_encode([
                'error' => '401',
                'message' => 'Accesso negato, utente non trovato'
            ]);
            break;
        case 0 | 1:
            session_start(array("id"=>uniqid()));
            setcookie("idSession",$_SESSION['id'],time()*60*60*24);
            echo json_encode([
                'error' => '200',
                'message' => 'Accesso consentito'
            ]);
            break;
    }

?>