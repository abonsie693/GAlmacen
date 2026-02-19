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
               <?php
                // llamamos la la función total_almacen() para indicar el valor total de lo que se lista
                $sentenc="select TOTALALMACEN() AS TOTAL";
                // Ejecuta la sentencia
                $result=mysqli_query($c,$sentenc);
                // Toma el valor del total
                $reg=mysqli_fetch_array($result);
               ?>               
               <h2> VALOR ACTUAL DEL ALMACÉN: <?php echo $reg[0];?>€</h2>	
            </div>
		   </div>		
		</div>	
		<div class="row text-center">	
			<div class="text-center mx-auto col-10">		
               <?php
               
               // Seleccionamos la tabla con la que vamos a trabajar
               $tabla="procedencia";// Escribir entre comillas el nombre de la tabla a listar
               
               // Establecemos la sentencia SQL de la Consulta a realizar
               $sentencia="select * from $tabla";
               
               // Dibujamos una tabla HTML para mostrar los valores almacenados
               echo '<table class="table table-condensed table-striped w-75 mx-auto">';
               
               // Recopilar los nombres de las columnas de la tabla seleccionada
               $cabeceras=mysqli_query($c,"SHOW FIELDS FROM $tabla");
               
               // Construye la fila de cabeceras
               echo "<tr class='table-info'>";
               while ($cab=mysqli_fetch_row($cabeceras)){
                  echo "<th scope='col'>$cab[0]</th>";
               }
               echo "<th scope='col'>PRODUCTOS</th>";
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
                     echo "<td><h5>";
                     //echo '<a data-bs-toggle="collapse" href="#dato'.$i.'" aria-expanded="false" aria-controls="#dato'.$i.'">';
                      echo $registro[$i];                      
                     //echo '</a>';
                     //echo '<div class="collapse" id="dato'.$i.'">';
                     //echo '   <div class="card card-body">';
                     //echo '       Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.';
                     //echo '   </div>';
                     //echo '</div>';
                     echo "</h5></td>";
                     // Incrementamos el contador de columnas
                     $i++;
                  }
                     echo '<td>';
                     echo '<button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#detalles'.$registro[0].'">';
                     echo 'Ver';
                     echo '</button>';
                     echo '</td>';
                  // Fin de la fila
                  echo "</tr>";		
                  // Fila colapsable (inicialmente oculta) 
                  echo '<tr class="collapse table-warning" id="detalles'.$registro[0].'">';
                  echo '   <td colspan="4">';           
                    echo " <h4>Productos de $registro[0] actualmente en el Almacén</h4>";
                    // Consulta todos los productos de ese pais
                    $consultaproductospais="select nombreproducto, precio, stock, precio*stock as valor, foto from productos where pais='$registro[0]'";
                    //echo $consultaproductospais;
                    $R=mysqli_query($c,$consultaproductospais);
                  // Dibujamos una tabla HTML para mostrar los valores almacenados
                  echo '<table class="table table-condensed table-striped w-90 mx-auto">';
                              
                 // Construye la fila de cabeceras
                 echo "<tr class='table-dark'>";
                    echo "<th scope='col'>PRODUCTO</th>";
                    echo "<th scope='col'>PRECIO</th>";                    
                    echo "<th scope='col'>STOCK</th>";
                    echo "<th scope='col'>VALOR</th>";
                    echo "<th scope='col'>FOTO</th>";
                 echo "</tr>";
                 
                  // Recorremos $resultado mostrando cada fila de la tabla
                  while ($reg = mysqli_fetch_row($R)){
                    
                    echo "<tr>";
                    $K=0;
                    foreach ($reg as $fila){
                        echo "<td>";
                        if ($K == 0) 
                            echo "<img src='imagenes/$reg[4]' height='50px'><br>$reg[$K]";
                        else
                            echo "$reg[$K]";   
                        echo "</td>"; 
                        $K++;
                    }
                  // Cerramos la segunda tabla                  
                  echo '</tr>';
                  }
                  echo '</table>';
                  echo '   </td>';
                  echo '</tr>';
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
                    echo '	  <a class="page-link" href="ValorPais.php?pagina='.$anterior.'">&laquo;</a>';
                    echo '	</li>';
                    for ($i=1;$i<=$numpag;$i++)
                    {
                        if($i==$pagina){
                                echo '	<li class="page-item active">';
                                echo '	  <a class="page-link"href="ValorPais.php?pagina='.$i.'">'.$i.'</a>';
                                echo '	</li>';						
                            }
                            else{
                                echo '	<li class="page-item"><a class="page-link" href="ValorPais.php?pagina='.$i.'">'.$i.'</a></li>';
                            }
                    }
                    echo '	<li class="page-item ">';
                    echo '	  <a class="page-link" href="ValorPais.php?pagina='.$siguiente.'">&raquo;</a>';
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