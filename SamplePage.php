<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marcelo Praia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</head>
<body>
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUbkK9PKb7j1o1oKZJssu60EK0vOk3-MznKQ&usqp=CAU" alt="Logo" width="30" height="24" class="d-inline-block align"> Marcelo Praia
    </a>
  </div>
</nav>
<?php

  /* Connect to MySQL and select the Tabelabase. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the EMPLOYEES table exists.*/
  VerifyEmployeesTable($connection, DB_DATABASE);

  /* If input fields are populated, Adicionar a row to the EMPLOYEES table. */
  $employee_name = htmlentities($_POST['NAME']);
  $employee_address = htmlentities($_POST['ADDRESS']);

  if (strlen($employee_name) || strlen($employee_address)) {
    AddEmployee($connection, $employee_name, $employee_address);
  }

  VerifyBeachTable($connection, DB_DATABASE);

  $beach_name = htmlentities($_POST['BEACH_NAME']);
  $beach_city = htmlentities($_POST['BEACH_CITY']);
  $beach_waves = htmlentities($_POST['BEACH_WAVES']);
  $beach_temp = htmlentities($_POST['BEACH_TEMP']);
  $beach_photo = htmlentities($_POST['BEACH_PHOTO']);


    if (strlen($beach_name) || strlen($beach_city) || strlen($beach_waves) || strlen($beach_temp)) {
        AddBeach($connection, $beach_name, $beach_city, $beach_waves, $beach_temp, $beach_photo);
    }
?>
<!-- Employee Input form -->
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Adicionar Funcionário</h2>
                <!-- Employee Input form -->
                <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="employeeName" name="NAME" maxlength="45">
                    </div>
                    <div class="mb-3">
                        <label for="employeeAddress" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="employeeAddress" name="ADDRESS" maxlength="90">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Funcionário</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Adicionar Praia</h2>
                <!-- Beach Input form -->
                <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="beachName" class="form-label">Nome da praia</label>
                        <input type="text" class="form-control" id="beachName" name="BEACH_NAME" maxlength="45">
                    </div>
                    <div class="mb-3">
                        <label for="beachCity" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="beachCity" name="BEACH_CITY" maxlength="90">
                    </div>
                    <div class="mb-3">
                        <label for="beachWaves" class="form-label">Tamanho médio das ondas</label>
                        <input type="text" class="form-control" id="beachWaves" name="BEACH_WAVES" maxlength="90">
                    </div>
                    <div class="mb-3">
                        <label for="beachTemp" class="form-label">Temperatura média</label>
                        <input type="text" class="form-control" id="beachTemp" name="BEACH_TEMP" maxlength="90">
                    </div>
                    <div class="mb-3">
                        <label for="beachPhoto" class="form-label">URL(foto da praia)</label>
                        <input type="text" class="form-control" id="beachPhoto" name="BEACH_PHOTO" maxlength="90">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Beach</button>
                </form>
            </div>
        </div>
</div>

<!-- Display table Tabela for Employees. -->
<div class="container">
        <h2>Tabela de Funcionários</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display Employees
                $result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");

                while ($query_data = mysqli_fetch_row($result)) {
                    echo "<tr>";
                    echo "<td>", $query_data[0], "</td>",
                    "<td>", $query_data[1], "</td>",
                    "<td>", $query_data[2], "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
</div>

<div class="container">
        <h2>Tabela de Praias</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Tamanho</th>
                    <th scope="col">Temperatura média</th>
                    <th scope="col">URL da foto da praia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display Beaches
                $result = mysqli_query($connection, "SELECT * FROM Beach");

                while ($query_data = mysqli_fetch_row($result)) {
                    echo "<tr>";
                    echo "<td>", $query_data[0], "</td>",
                    "<td>", $query_data[1], "</td>",
                    "<td>", $query_data[2], "</td>",
                    "<td>", $query_data[3], "</td>",
                    "<td>", $query_data[4], "</td>",
                    "<td><img src='" . $query_data[5] . "' height='200' width='500'/></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
</div>
<!-- Clean up. -->
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>

<?php

// Adicionar an employee to the table
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee Tabela.</p>");
}

// Adicionar a beach to the table
function AddBeach($connection, $beach_name, $beach_city, $beach_waves, $beach_temp, $beach_photo) {
   $n = mysqli_real_escape_string($connection, $beach_name);
   $c = mysqli_real_escape_string($connection, $beach_city);
   $w = mysqli_real_escape_string($connection, $beach_waves);
   $t = mysqli_real_escape_string($connection, $beach_temp);
   $p = mysqli_real_escape_string($connection, $beach_photo);

   $query = "INSERT INTO Beach (BEACH_NAME, BEACH_CITY, BEACH_WAVES, BEACH_TEMP, BEACH_PHOTO) VALUES ('$n', '$c', '$w', '$t', '$p');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding beach Tabela.</p>");
}
?>

<?php
// Function to check whether the table exists and, if not, create it.
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $query = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating EMPLOYEES table.</p>");
  }
}

// Function to check whether the beach table exists and, if not, create it.
function VerifyBeachTable($connection, $dbName) {
  if(!TableExists("Beach", $connection, $dbName))
  {
     $query = "CREATE TABLE Beach (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         BEACH_NAME VARCHAR(45),
         BEACH_CITY VARCHAR(90),
         BEACH_WAVES FLOAT,
         BEACH_TEMP DECIMAL(5,2),
         BEACH_PHOTO VARCHAR(255)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating Beach table.</p>");
  }
}

// Check for the existence of a table.
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}

// Verify if the tables exist and create them if they don't.
VerifyEmployeesTable($connection, DB_DATABASE);
VerifyBeachTable($connection, DB_DATABASE);
?>
</body>
</html>
