<?php
class db{
/**
 * Connessione con database locale mySQL
 *
 * @param [String] $dbname nome del database col quale iniziare a comunicare
 * @param [String] $username nome utente autorizzato a comunicare con il database
 * @param [String] $password password dell'utente autorizzato a comunicare con il database
 * @return [PDO] $pdo oggetto di connessione con il database
 * @throws [PDOException] $e errore di connessione con il database
 */
private $pdo;
function __construct(String $dbname='',String $username='',String $password=''){

    is_null($dbname or $username or $password) ? throw new TypeError("inserire parametri", 1, ): null;
    $this->pdo = new PDO('mysql:host=localhost; dbname='.$dbname, $username, $password); 
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// PDO::ATTR_ERRMODE: server ad impostare la modalita con la quale vendogo generati gli errori
                                                                // PDO::ERRMODE_EXCEPTION: restituisce un'eccezione, PDO::ERRMODE_SILENT: non restituisce nulla, PDO::ERRMODE_WARNING: restituisce un warning e continua l'esecuzione       
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);// PDO::FETCH_ASSOC: restituisce un array indicizzato col nome delle colonne in suo valore pdo::FETCH_NUM: restituisce un array indicizzato col numero delle colonne in suo valore pdo::FETCH_BOTH: restituisce un array indicizzato col nome e col numero delle colonne in suo valore   
}

function __destruct(){
    $this->pdo=null;
}

function goDb(string $value,array $post){
    $value=$this->pdo->prepare($value);
    foreach($post as $key=>$value){
        $value->bindValue($value,':'.$key);
    }
  $value->execute();
  return $value->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
