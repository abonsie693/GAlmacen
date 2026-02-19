<?php
    // Inserta el marco superior 
	require_once('marcosup.php');
?> 
<!--
<nav class="navbar py-2 navbar-light text-left bg-warning" id="2" style="	background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8));	background-position: top left;	background-size: 100%;	background-repeat: repeat;">
  <span class="navbar-text text-left text-dark"><hr><b>Consulta modo contenedores</b></span>
</nav>
-->     
 	<div class="py-3">
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-primary">Catálogo de Productos</h1>
				</div>	
			</div>		
			<div class="row">
				<?php
					// Seleccionamos la tabla con la que vamos a trabajar
					$tabla="productos";// Escribir entre comillas el nombre de la tabla a listar
					
					// Establecemos la sentencia SQL de la Consulta a realizar
					$sentencia="select * from $tabla";
					
					// Recopilar las filas almacenadas en la tabla
					$resultado=mysqli_query($c,$sentencia);
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
					// Como vamos a usar 8 registros por página dividimos entre seis
					$numpag= ceil($numreg/8);    
					
					// Calcula cuál será el registro de inicio para construir la consulta
					$inicio=($pagina-1)*8;
					
					// Volvemos a ejecutar la sentencia pero fijando los límites.
					$sentencia .=" limit ".$inicio.", 8";
					$resultado=mysqli_query($c,$sentencia);
					//echo "<hr>$sentencia<hr>";
					// --- --- --- --- --- --- --- --- --- --- --- ---
					// Recorremos $resultado mostrando cada fila de la tabla
					while ($registro = mysqli_fetch_row($resultado)){
						// Construimos la entrada para cada fila de la tabla
						echo '<div class="rounded py-3 mx-0 my-1 col-3 border border-primary">';
							echo "<p>Producto: <strong>$registro[1]</strong></p>";
                            echo "<h6>$registro[2]</h6>";						
                            echo "<p>";
                            echo "<img src='imagenes/$registro[5]' height='50px'>";
                            echo'</p>';
						echo '</div>';					
					}
					
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
                    echo '	  <a class="page-link" href="Catalogo.php?pagina='.$anterior.'">&laquo;</a>';
                    echo '	</li>';
                    for ($i=1;$i<=$numpag;$i++)
                    {
                        if($i==$pagina){
                                echo '	<li class="page-item active">';
                                echo '	  <a class="page-link"href="Catalogo.php?pagina='.$i.'">'.$i.'</a>';
                                echo '	</li>';						
                            }
                            else{
                                echo '	<li class="page-item"><a class="page-link" href="Catalogo.php?pagina='.$i.'">'.$i.'</a></li>';
                            }
                    }
                    echo '	<li class="page-item ">';
                    echo '	  <a class="page-link" href="Catalogo.php?pagina='.$siguiente.'">&raquo;</a>';
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
    // Inserta el marco inferior 
	require_once('marcoinf.php');
?>
