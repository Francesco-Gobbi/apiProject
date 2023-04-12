<?php
    try{
     
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
    <form method="POST" action="./check.php">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit" value="login">Login</button>
    </form>
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
    <button type="submit" name="submit" value="register" onclick="location.href='register.php'">Register<button>
</body>

</html>
<?php
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>