<?php
	require_once('marcosup.php');
	
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
                
               <h2> LISTADO DE PROVEEDORES  </h2>	
               <p><a href="AProveedores.php">Añadir nuevo proveedor</a></p>
            </div>
		   </div>		
		</div>	
		<div class="row text-center">	
			<div class="text-center mx-auto col-10">		
               <?php
               
               // Seleccionamos la tabla con la que vamos a trabajar
               $tabla="proveedores";// Escribir entre comillas el nombre de la tabla a listar
               
               // Establecemos la sentencia SQL de la Consulta a realizar
               $sentencia="select * from $tabla";
               
               // Dibujamos una tabla HTML para mostrar los valores almacenados
               echo '<table class="table table-condensed">';
               
               // Recopilar los nombres de las columnas de la tabla seleccionada
               $cabeceras=mysqli_query($c,"SHOW FIELDS FROM $tabla");
               
               // Construye la fila de cabeceras
               echo "<tr bgcolor='#f0f000'>";
               while ($cab=mysqli_fetch_row($cabeceras)){
                  echo "<th>$cab[0]</th>";
               }
               echo "<th>Productos</th>";
               echo "</tr>";
               
               // Recopilar las filas almacenadas en la tabla
               $resultado=mysqli_query($c,$sentencia);
               //--------------------------------------------------------------------------------------------------
                // Primera parte. Preparación paginación. 
                // Este código hay que añadirlo tras ejecutar la sentencia para saber 
                // el total de registros de la consulta y poder calcular el número de páginas
                // --- --- --- --- --- --- --- --- --- --- --- ---
                // --- --- --- Preparamos la paginación -- --- --- 
                // comprueba si viene número de página   
                if (isset($_GET['pagina']))
                    {
                    $pagina=$_GET['pagina'];
                    }
                    else{
                    $pagina=1;  
                    } 
                // Calculamos el número de páginas que tenemos que usar para visualizar el resultado
                //$numreg=mysql_num_rows($resultado);
                $numreg=mysqli_num_rows($resultado);
                // Como vamos a usar 6 registros por página dividimos entre seis
                $numpag= ceil($numreg/6);    
                
                // Calcula cuál será el registro de inicio para construir la consulta
                $inicio=($pagina-1)*6;
                
                // Volvemos a ejecutar la sentencia pero fijando los límites.
                $sentencia .=" limit ".$inicio.", 6";
                $resultado=mysqli_query($c,$sentencia);
                //echo "<hr>$sentencia<hr>";
                // --- --- --- --- --- --- --- --- --- --- --- ---

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
                  // Añade una columna para 
                  //echo "<td> <a href='CProcedimientoProdProv.php'>Rutina</a>";
                  echo '<td>';
                  echo'<form name="verproductos" method="POST" action="CProcedimientoProdProv.php">';
                    echo '<input type="hidden" name="cif" value="'.$registro[0].'">';
                    echo '<input type="hidden" name="nombre" value="'.$registro[1].'">';
                    echo '<input type="image" src="estilos/estrella4.png" title="Productos del proveedor ... '.$registro[1].'" width="20">';
                  echo "</form>";
                  echo "</td>";
                  // Fin de la fila
                  echo "</tr>";				
               }
               
               // Fin de la tabla HTML
               echo "</table>";
               //--------------------------------------------------------------------------------------------------
                // Segunda parte. Paginador.
                // Este código se añade al final de la consulta en la última sección row
                // --- --- --- --- --- --- --- --- --- --- --- ---
                    // --- Mostramos el paginador ---       
                    // Calcula páginas anterior y siguiente
                    if ($pagina==1){
                        $anterior=1;
                    }
                    else{
                        $anterior=$pagina-1;
                    }
                    if ($pagina==$numpag){
                        $siguiente=$pagina;
                    }
                    else{
                        $siguiente=$pagina+1;
                    }
                    
                    echo "<div class='col-md-12 text-center'>"; // Fin de la capa row  
                    echo '<ul class="pagination justify-content-center ">';
                    echo '	<li class="page-item ">';
                    echo '	  <a class="page-link" href="CProveedores.php?pagina='.$anterior.'">&laquo;</a>';
                    echo '	</li>';
                    for ($i=1;$i<=$numpag;$i++)
                    {
                        if($i==$pagina){
                                echo '	<li class="page-item active">';
                                echo '	  <a class="page-link"href="CProveedores.php?pagina='.$i.'">'.$i.'</a>';
                                echo '	</li>';						
                            }
                            else{
                                echo '	<li class="page-item"><a class="page-link" href="CProveedores.php?pagina='.$i.'">'.$i.'</a></li>';
                            }
                    }
                    echo '	<li class="page-item ">';
                    echo '	  <a class="page-link" href="CProveedores.php?pagina='.$siguiente.'">&raquo;</a>';
                    echo '	</li>';
                    echo '  </ul>';
                    
                    // --- Fin paginación ---
               // Cerramos la conexión con la base de datos
               mysqli_close($c);
               
               ?>   	
		   </div>		
		</div>
   </div>

<?php
	require_once('marcoinf.php');
?>	
