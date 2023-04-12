<?php
try { 
     if(isset($_POST['login']))
     {
        require_once('../method-page/db.php');
        $pdo = dbConnection('progetto', 'root', '');
       //* configuazione del db
       error_reporting(E_ERROR | E_PARSE);
         isset($_POST['error']) ? throw new Exception($_POST['error']) : null;
         session_start();
         
       $select=$pdo->prepare('SELECT * FROM utente WHERE username = :username AND password = :password'); 
       //* constrollo lato server delle credenziali passate
       $username = preg_match("/^[a-z0-9]{4,15}$/i", preg_match('/!\s/',$_POST['username'])) ?
           $_POST['username']: throw new Exception('nome non valido');
       $password = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#?=^|\!$&%£ \/()[]])[a-zA-Z\d]{8,}$/", preg_match('/!\s/',$_POST['password'])) ? $_POST['password']: throw new Exception('password non valida');
   
       //*ricerca utente nel db
       $select->bindParam(":username", $username, PDO::PARAM_STR); // PARAM_ ... indica come deve essere interpretato il dato passato Es sting, int, bool
       $select->bindParam(":password", $password, PDO::PARAM_STR);
       $select->execute();
           if($select->rowCount() > 0 ){
               $_SESSION['username'] = $_POST['username'];
               $_SESSION['id'] = $select->fetch()['ID'];
               header('location: ../index.php',);
           }else{

               throw new Exception('username o password errati');
           }
    }
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>

    <body>
        <form action="" method="post">
            <br>
            <input type="text" name="user" placeholder="inserisci username o email" required>
            <input type="password" name="psw" placeholder="inserisci password" onchange="check()">
            <div id="error">

            </div>
            <input type="submit" name="login" value="true" action="Login">
        </form>
        <button onclick="windows.location.href='./register.php'">Sign Up</button>
        <script>//todo: da sistemare
            async function check() {
                var psw = document.forms["myForm"]["psw"].value;
                document.getElementById("error").append= 
                    RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#?=^|\!$&%£ \/()[]])[a-zA-Z\d]{8,}$").test(psw) ? "": "la password deve contenere almeno un numero, una lettera maiuscola, una minuscola e un carattere speciale";
            }
        </script>
    </body>

    </html>
    <script>
        //funzione asincrona per operazioni di richiesta GET, POST ecc  
        /*  function login(){
              fetch("./login/check.php",{ 
                  method:"POST",
                  body:{
                      usename: document.forms["myForm"]["username"].value,
                      password: document.forms["myForm"]["password"].value
                  },
                  headers:{
                      'Content-Type': 'application/json'
                  }
              })
              .then(res=>res.json())
              .then(date=>{
                  if(date){
                      console.log(JSON.stringify(date));
                     // window.location.href = "../index.php";

                  }else{
                      ErrorEvent("Errore: username o password errati")
                  }

              })
              //todo: scegliere il metodo per gestire gli errori
              .catch( e =>{
                  console.error("Erorre: ?",e)
              });
          }
          function elimina(){
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("demo").innerHTML = this.responseText;
                  }
              };
              xhttp.open("GET","check.php", true);
              xhttp.send();
          }*/
    </script>
<?php
   } catch (PDOException | Error | Exception $e) {
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['error'] = $e->getMessage();
    header('location: ../index.php',);
 }
?>