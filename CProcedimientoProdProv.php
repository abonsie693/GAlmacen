<?php
	require_once('marcosup.php');

	// Recoge la variables 
	$cifprov=$_POST['cif']; 
   $nombreprov= $_POST['nombre']; 
?>
<!--
<nav class="navbar py-2 navbar-light text-left bg-warning" id="2" style="	background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8));	background-position: top left;	background-size: 100%;	background-repeat: repeat;">
  <span class="navbar-text text-left text-dark"><hr><b>Consulta modo tabla</b></span>
</nav>
-->
   <div class="py-3 bg-warning" >
      <div class="container">
        <div class="row text-center">
		      <div class="text-center mx-auto col-10">
               <h2> LISTADO DE PRODUCTOS DEL PROVEEDOR 
               <?php
                  echo $nombreprov;
               ?>
               </h2>	
            </div>
		   </div>		
		</div>	
		<div class="row text-center">	
			<div class="text-center mx-auto col-10">		
               <?php
               
               // Seleccionamos la tabla con la que vamos a trabajar
               $tabla="proveedores";// Escribir entre comillas el nombre de la tabla a listar
               
               // Establecemos la sentencia SQL de la Consulta a realizar
               $sentencia="CALL Productos_del_proveedor('$cifprov')";

               // Recopilar las filas almacenadas en la tabla
                $resultado=mysqli_query($c,$sentencia);

                $numreg=mysqli_num_rows($resultado);
                if ($numreg==0)
                  {
                  echo "$nombreprov aún no ha servido productos.";
                  }
                  else{
                     // Dibujamos una tabla HTML para mostrar los valores almacenados
                     echo '<table class="table table-condensed">';
                                    
                     // Construye la fila de cabeceras
                     echo "<tr bgcolor='#f0f000'>";
                     echo "<th>Nombre</th>";
                     echo "<th>Descripción</th>";
                     echo "<th>Pais</th>";
                     echo "</tr>";                             
                     
                     //--------------------------------------------------------------------------------------------------
                  
                     // Recorremos $resultado mostrando cada fila de la tabla
                     while ($registro = mysqli_fetch_row($resultado)){
                        
                        // Iniciamos la fila
                        echo "<tr>";
                        
                        // Iniciar un contador de columnas
                        $i=0;
                        
                        // Recorremos y mostramos el valor de cada columna
                        foreach ($registro as $fila){
                              
                              // Mostramos el valor de cada celda
                              echo "<td> $registro[$i]</td>";
                              
                              // Incrementamos el contador de columnas
                              $i++;
                        }
                        
                        // Fin de la fila
                        echo "</tr>";				
                     }
                     
                     // Fin de la tabla HTML
                     echo "</table>";
               }
               // Cerramos la conexión con la base de datos
               mysqli_close($c);
               
               ?>   	
		   </div>		
		</div>
   </div>

<?php
	require_once('marcoinf.php');
?>	
