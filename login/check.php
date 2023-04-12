<?php
 try {

    //* configuazione del db
    error_reporting(E_ERROR | E_PARSE);
    $pdo = new PDO('mysql:host=localhost; dbname=prova', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// PDO::ATTR_ERRMODE: server ad impostare la modalita con la quale vendogo generati gli errori
                                                                // PDO::ERRMODE_EXCEPTION: restituisce un'eccezione, PDO::ERRMODE_SILENT: non restituisce nulla, PDO::ERRMODE_WARNING: restituisce un warning e continua l'esecuzione       
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);// PDO::FETCH_ASSOC: restituisce un array indicizzato col nome delle colonne in suo valore pdo::FETCH_NUM: restituisce un array indicizzato col numero delle colonne in suo valore pdo::FETCH_BOTH: restituisce un array indicizzato col nome e col numero delle colonne in suo valore   
    $select=$pdo->prepare('SELECT * FROM utente WHERE username = :username AND password = :password'); 
    
    //* constrollo lato server delle credenziali passate
    /*$username = preg_match("/^[a-z0-9]{4,15}$/i", preg_match('/!\s/',$_POST['username'])) ?
        $_POST['username']: throw new Exception('nome non valido');
    $password = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#?=^|\!$&%£ \/()[]])[a-zA-Z\d]{8,}$/", preg_match('/!\s/',$_POST['password'])) ? $_POST['password']: throw new Exception('password non valida');

    //*ricerca utente nel db
    //todo: studia pdo
    $select->bindParam(":username", $username, PDO::PARAM_STR); // PARAM_ ... indica come deve essere interpretato il dato passato Es sting, int, bool
    $select->bindParam(":password", $password, PDO::PARAM_STR);
    $select->execute();
        if(isset($select->fetch())){*/
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
           // $_SESSION['id'] = $select->fetch()['ID'];
           
            header('location: ../index.php',);
       /* }else{
        
            throw new Exception('username o password errati');
        }*/
} catch (PDOException | Error | Exception $e) {
   $_SESSION['error'] = $e->getMessage();
   header('location: ../index.php',);
}
?>

