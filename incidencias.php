<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Incidencias</title>
</head>
<body>

    <h1>Bienvenido <?php echo $_SESSION["usuario"]; ?></h1>

</body>
</html>