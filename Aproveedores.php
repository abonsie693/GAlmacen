<?php 	//Iniciamos código PHP
	//Cargar el marco superior
	require_once('marcosup.php');
?>

   <div class="col-10">
        <h1>Alta de Proveddor</h1>
        <h4>Si quieres ser uno de nuestros proveedores completa el siguiente formulario.</h4>
    </div>

    <div class="p-2">
	    <form name="ficha" action="VisorAltaProveedor.php" method="POST" enctype="multipart/form-data">		
            <!-- CIF del proveedor -->
            <div>	
                CIF del Proveedor: 
                <br>
                <input type="text" name="cif" size="40">
            </div>  
            <!-- Nombre del Proveedor -->
            <div>	
                Proveedor nombre: 
                <br>
                <input type="text" name="nombre" size="40">
            </div> 
            <!-- Dirección proveedor -->
            <div>	
                Dirección proveedor: 
                <br>
                <input type="text" name="direccion" size="40">
            </div>  
            <!-- Nacionalidad del Proveedor -->
            <div>	
                Nacionalidad del proveedor: 
                <br>
                <input type="text" name="nacionalidad" size="40">
            </div> 
            <!-- Representante del proveedor -->
            <div>	
                Nombre del representante: 
                <br>
                <input type="text" name="poblacion" size="40">
            </div>             
            <!-- Email -->
            <div>	
                Correo electrónico del proveedor: 
                <br>
                <input type="mail" name="email" size="40">
            </div> 
            <!-- Teléfono -->
            <div>	
                Teléfono del proveedor: 
                <br>
                <input type="text" name="telefono" size="40">
            </div> 
            <br>

            <div class="form-group text-center bg-primary p-2">
                <INPUT TYPE="submit" VALUE="Enviar datos ">
                    - 
                <INPUT TYPE="reset"  VALUE="Borrar los datos">   
            </div>                              
		</form>        
        
        <div class="bg-primary text-light">    
            <div class="col-4">   
                
            </div>
            <div class="p-2 bg-primary text-white text-center">                
                <form action="CProveedores.php" method="post">
                    <p>Volver...
                    <input type="image" SRC="estilos/BTNVOLVER.jpg" name="volver" height="30" ALT="volver">
                    </p> 
                </form>
            </div>
            <div class="col-4">   
                
            </div>
        </div>
    </div>                


<?php
	//Iniciamos código PHP
	//Cargar el marco inferior
	require_once('marcoinf.php');
	// Fin del código PHP
?>  
  