<!DOCTYPE html>
<html>
<head>
   <title>Selección</title>
</head>
<body><center>
   <img src="./LogoStimey.jpg" alt="Logo Stimey"/>
      <form name="form1" action="selectGrupo.php" method="post">
         <div>
            <?php 
                  session_start();
                  echo "Bienvenido: ". $_SESSION['usuario'];
            ?>
            <br><br>
            Seleccione un grupo de trabajo
            <br><br>
            <select name="origen" id="origen">
               <option value="contratacion">Contratación</option>
               <option value="subcontratacion">Subcontratación y factura</option>
               <option value="existencias" >Existencia</option>
               <option value="inmovilizado" >Inmovilizado</option>
            </select>
            <input type="submit" value="Cargar" name="cargar" onclick="" >
         </div>
      </form>
      <br>
	<center>
		<form method=\"POST\" action=\"opcionesSupervisor.php\">
        	      <button type=\"submit\">Volver</button>
		</form>
  	</center>
</center>
</body>
</html>