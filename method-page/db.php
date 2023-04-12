<?php
/**
 * Connessione con database locale mySQL
 *
 * @param [String] $dbname nome del database col quale iniziare a comunicare
 * @param [String] $username nome utente autorizzato a comunicare con il database
 * @param [String] $password password dell'utente autorizzato a comunicare con il database
 * @return [PDO] $pdo oggetto di connessione con il database
 * @throws [PDOException] $e errore di connessione con il database
 */

function dbConnection(String $dbname,String $username,String $password){
    try{
   
    is_null($dbname or $username or $password) ? throw new TypeError("inserire parametri", 1, ): null;
    $pdo = new PDO('mysql:host=localhost; dbname='.$dbname, $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// PDO::ATTR_ERRMODE: server ad impostare la modalita con la quale vendogo generati gli errori
                                                                // PDO::ERRMODE_EXCEPTION: restituisce un'eccezione, PDO::ERRMODE_SILENT: non restituisce nulla, PDO::ERRMODE_WARNING: restituisce un warning e continua l'esecuzione       
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);// PDO::FETCH_ASSOC: restituisce un array indicizzato col nome delle colonne in suo valore pdo::FETCH_NUM: restituisce un array indicizzato col numero delle colonne in suo valore pdo::FETCH_BOTH: restituisce un array indicizzato col nome e col numero delle colonne in suo valore   
    return $pdo;

    }catch(PDOException | Error $e){
        header ("Location: {$_FILES['file']['name']}; method=post; errore=".$e->getMessage(), true, 301);
        exit;
    }
}

strtr($string, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES)));
strchr($string, $char);
$array = [1,2];
$array1 = [3,4];
$num.array_map(function(...$value) use ($array,$array1){return $value * 2;}, $return);


?>
