<!DOCTYPE html>
<?php 
	error_reporting(E_ERROR);
	session_start();
	$usuario=$_SESSION['usuario'];
	$pass=$_SESSION['passwd'];
    $acceso=$_SESSION['idUsuario'];
    if($acceso!=1 && $acceso!=3){
        echo '<script language="JavaScript">'; 
            echo 'alert("Acceso no permitido");'; 
        echo '</script>';
        header("Refresh: 1; url=Contrataciones.php"); 
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Busqueda auditar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        table{
            border: 1px solid black;
            border-collapse: collapse;
            width: 90%;
            text-align: center;
        }
        td, th, tr{
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <h2>Busqueda</h2>
    <form action="buscarAuditar.php" method="POST">
        <fieldset>
            <legend>Buscador</legend>
            <label>DNI/NIF</label><input type="text" name="buscarDNI" placeholder="DNI/NIF"><br>
            <label>Apellido</label><input type="text" name="buscarApellido" placeholder="DNI"><br>
        <input type="submit" value="Buscar">
        </fieldset>
    </form>
    <?php
        include 'conexion/conexion_db.php';
        $dni = $_POST['buscarDNI'];
        $apellido = $_POST['buscarApellido'];
        $consulta = "SELECT ID ,Nombre, primerApellido, segundoApellido, NIF FROM Datos_Personales WHERE NIF = '".$dni."' OR primerApellido = '".$apellido."' OR segundoApellido='".$apellido."';";
        $ejecutar_consulta = mysqli_query($conexion, $consulta);
    ?>

        <form action="realizarAuditoria.php" method="POST" name="consulta">
        <br><br>
        <h2>Contratos</h2>
        <?php
            echo '<table>';
                echo '<tr><th></th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>DNI</th></tr>';
                while($fila = mysqli_fetch_array($ejecutar_consulta, MYSQLI_ASSOC))
                {
                    $id = $fila['ID'];
                    $a = $fila['Nombre'];
                    $b = $fila['primerApellido'];
                    $c = $fila['segundoApellido'];
                    $d = $fila['NIF'];

                        echo '<!--Listado de trabajadores dentro de la tabla-->';
                        echo '<tr>';
                            echo '<td><input type="radio" name="idPersona" value="'.$id.'"></td>';
                            echo '<td>'.$a.'</td>';
                            echo '<td>'.$b.'</td>';
                            echo '<td>'.$c.'</td>';
                            echo '<td>'.$d.'</td>';
                        echo '</tr>';
                }
        
            echo '</table><br>';
        ?>
            <input type="submit" value = "Consultar" name="consu"><br>
            <a href="Contrataciones.php"><input type="button" value="Atras"></a>
        </form>
</body>
</html>