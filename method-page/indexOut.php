<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="html/php" />
    <meta lang="it">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<button class="w3-bar-item w3-button w3-large" id="icOP" onclick="sideBar_OP()">&#9776;</button>
    <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="sideBar">  
            <button class="w3-bar-item w3-button w3-large w3-center" id="icCL" onclick="sideBar_CL()">Close &times;</button>  
            <div class="w3-center"> 
                <a href="./login/login.php" class="w3-button">Login</a>/<a href="./login/login.php" class="w3-button">Logout</a>
            </div> 
    </div> 
</nav>

<div id="contenuto" class="w3-main" style="margin-left:250px;">
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
                        <tr>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
  </div>

  <script>
    function sideBar_OP() {
        document.getElementById("sideBar").style.display="block";
        document.getElementById("icOP").style.display="none";
    }
    function sideBar_CL() {
        document.getElementById("sideBar").style.display = "none";
        document.getElementById("icOP").style.display="block";
    }
  </script>
</body>
</html>
</html>

