<?php 
	//Iniciamos código PHP
	//Cargar el marco superior
	require_once('marcosup.php');
?>
<div>
    <h1>Nuevo Proveedor.</h1>
</div>
<div>
    <?php
		// Recoge todas las variables 
		$cif=strtoupper($_POST['cif']);  // Lo pasa a mayúsculas 
		$nombre=$_POST['nombre']; 
		$direccion=$_POST['direccion'];  
		$nacionalidad=$_POST['nacionalidad'];   
		$poblacion=$_POST['poblacion'];         
		$email=$_POST['email'];
		$telefono=$_POST['telefono'];

        // visualiza todos los datos recogidos
            echo '<table style="width:90%; margin-left:20px; margin-right:40px">';
            echo "<tr><td>CIF: </td><td><b>",$cif,"</b></td></tr>";
            echo "<tr><td>Nombre: </td><td><b>",$nombre,"</b></td></tr>";
            echo "<tr><td>Dirección: </td><td><b>",$direccion,"</b></td></tr>";
            echo "<tr><td>Nacionalidad:  </td><td><b>",$nacionalidad,"</b></td></tr>";		
            echo "<tr><td>Población:  </td><td><b>",$poblacion,"</b></td></tr>";        
            echo "<tr><td>EMail:  </td><td><b>",$email,"</b></td></tr>";        
            echo "<tr><td>Teléfono:  </td><td><b>",$telefono,"</b></td></tr>";        
            echo "</table>";            

            // Recopilamos los datos para construir la sentencia de inserción
            $d1 = $cif; 
            $d2 = $nombre; 
            $d3 = $direccion; 
            $d4 = $nacionalidad;
            $d5 = $poblacion;
            $d6 = $email;  
            $d7 = $telefono; 
            
            // Construye la sentencia de inserción que hay que ejecutar
            $sentencia="INSERT INTO proveedores             
            VALUES ('$d1','$d2','$d3','$d4','$d5','$d6','$d7');";
                        
            // Muestra la sentencia de inserción que va a ejecutar
            echo "<hr>Sentencia:<br><h5>", $sentencia, "</h5><hr>";

            // Ejecuta la sentencia SQL para añadir este registro a la BD.    
            if (mysqli_query($c, $sentencia))
            {
                echo "<h2>Proveedor $d2 registrado correctamente</h2>";
            }
            else
            {
                echo "<h2>¡¡Atención!!<br>No insertado. Hay errores en los datos de entrada.</h2><br>";
            }
		
        // Cerramos la conexión con la base de datos
        mysqli_close($c);
		?>
        <hr>
    </div>
    <div class="col-3">                
        <form action="CProveedores.php" method="post">
            <p class="close">Volver...
            <input type="image" SRC="estilos/BTNVOLVER.jpg" name="volver" height="30" ALT="volver">
            </p> 
        </form>
    </div>
    <?php
        //Cargar el marco inferior
        require_once('marcoinf.php');
        // Fin del código PHP
    ?>