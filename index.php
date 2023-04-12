<?php
/// todo: aggiugi metodi ajax, gestione errori, 
try {
    error_reporting(E_ERROR | E_PARSE);
    isset($_POST['error']) ? throw new Exception($_POST['error']) : null;
    $logged = isset($_SESSION['username']) && isset($_SESSION['password']) ? 1 : 0;
    echo $logged;
    echo $_SESSION['username']
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="html/php" />
        <meta lang="it">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Todo list</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>

    <body>
        <button class="w3-bar-item w3-button w3-large" id="icOP" onclick="sideBar_OP()">&#9776;</button>
        <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="sideBar">
            <button class="w3-bar-item w3-button w3-large w3-center" id="icCL" onclick="sideBar_CL()">Close &times;</button>
            <div class="w3-center">
                <?php $logged ?: print('<a href="./login/login.php" class="w3-button">Login</a>') ?>
                <?php !$logged ?: print("\<button class=\"w3-button\" onclick=\"window.location.href = './login/logout.php'; \">Logout</button>"); ?>
            </div>
        </div>
        </nav>

        <div id="contenuto" class="w3-main">
            <div class="w3-container">
                <h1>Todo list</h1>
                <div id="lite">
                    <table class="w3-table-all">
                        <thead>
                            <tr class="w3-gray">
                                <th>contenuto</th>
                                <th>Data</th>
                                <th>Priorità</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /*if($logged){
                            
                        foreach ( $srcPrenotazione->fetchAll() as $value) 
                                {
                                    echo ('<tr><td>' . $value['contenuto'] . 
                                            '</td><td>'. $value['date'] . 
                                            '</td><td>' . $value['priorità']. 
                                            '</td></tr>');
                                }   
                        }*/
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function sideBar_OP() {
                document.getElementById("sideBar").style.display = "block";
                document.getElementById("icOP").style.display = "none";
            }

            function sideBar_CL() {
                document.getElementById("sideBar").style.display = "none";
                document.getElementById("icOP").style.display = "block";

            }

            function logout() {
                fetch("./login/logout.php", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        credentials: 'include'
                    })
                    .then(res => {
                        if (res.ok) $logged = 0
                    })

            }
        </script>
    </body>

    </html>

    </html>
<?php
} catch (Exception $e) {
    echo $e->getMessage();
}
?>