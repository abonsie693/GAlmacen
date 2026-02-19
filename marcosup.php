<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">  
    <title>ESQUEMA COMERCIO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
         
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="icon" href="estilos/logoIESTuraniana.jpg">
</head>
<body>
  <div class="p-3 bg-warning text-dark text-center">          
          <h4>ESQUEMA DE COMERCIO</h4>
  </div>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid justify-content-center">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">INICIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Catalogo.php">PRODUCTOS</a>
        </li>
        <li class="nav-item">          
          <a class="nav-link" href="CProveedores.php">PROVEEDORES</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Vistas</a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-info-emphasis" href="ValorAlmacen.php">COSTE DEL ALMACÉN</a></li>
            <li><a class="dropdown-item text-info-emphasis" href="ValorPais.php">VALOR POR PAÍS</a></li>
            <li><a class="dropdown-item text-info-emphasis" href="ValorProductosPais.php">PRODUCTOS POR PAÍS</a></li>  
           
            <li><a class="dropdown-item text-info-emphasis" href="#">Consulta VISTA</a></li>  
            <li class="dropdown-divider"></li>            
            <li><a class="dropdown-item text-info-emphasis" href="#">Consulta VISTA</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Ayuda</a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-warning-emphasis" href="Ayuda.php">Gest. Almacen</a></li>
            <li class="dropdown-divider"></li>                        
            <li><a class="dropdown-item text-info-emphasis" href="Trastienda/GU/Ayuda.php">Gest. Usuarios</a></li>
          </ul>
        </li>
        <li class="nav-item">          
          <a class="nav-link" href="Zdespacho.php">ENTRAR</a>
        </li>
  </ul>   
    </div>
  </nav>
<?php
	// Invocamos el archivo con la conexión a la base de datos
	require_once('conexion.php');
?>
  
