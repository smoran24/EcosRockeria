<?php
    require_once 'paginator.php'; //requiere el uso del paginator.php para usar sus funciones de paginación
    require("conexion.php");
    $conn = conectar();
    $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 5; //setea el limite de elementos por pag
    $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //setea el numero de pagina
    $links = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7; //setea la cantidad de paginas a mostrar en los enlaces
    $query = "SELECT categoria, nombre, precio, artista, imagen FROM productos";
    $Paginator = new Paginator( $conn, $query );
    $results = $Paginator->getData( $page, $limit );
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
  <link href="./css/bootstrap.min.css" rel="stylesheet"> <!-- estilos del bootstrap -->
  <link href="./css/style.css" type="text/css" rel="stylesheet"> <!-- mis estilos-->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <title>Ecos Rockería - Productos</title>
</head>
<body>

  <div class="container-fluid" id="cabecera">
    <div class="row">
      <div class="col">
        <a href="index.html"><img src="./images/ecos-logo.png" alt="logo" width="100px" id="logo-cabecera"></a>
      </div>
      <div class="col" id="botones-cabecera">
        <a href="contacto.html">Contacto</a>
        <a class="active" href="catalogo.php">Catálogo</a>
      </div>
    </div>
  </div>
        
  <div class="container-fluid" id="primeraSeccion">
    <div class="row">
      <div class="col">
        <h2>PRODUCTOS EN STOCK</h2>
        <p id="titulo-busqueda">Recorré nuestro catálogo completo</p>
      </div>
        <div class="col">
          <form method="POST" action="busqueda.php"> <!--Envia (hace POST) a la busqueda a la pag busqueda.php-->
            <div class="form-row align-items-center">
              <div class="col-auto">
                <input required name="PalabraClave" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Buscar artículos...">  
                <input name="buscar" type="hidden" class="form-control mb-2" id="inlineFormInput" value="v">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-2">Buscar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container-fluid" id="segundaSeccion">
    <div class="row">
      <div class="col">
      <table class="table table-striped table-condensed table-bordered table-rounded">
                    <thead class="table-success table-striped">
                        <tr>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Artista</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>

                    <!--Aca estamos iterando a través de los resultados del atributo de datos que contiene los registros y creando una fila de tabla para cada uno-->
                    <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                    <tr>
                    <td><?php echo $results->data[$i]['categoria']; ?></td>
                    <td><?php echo $results->data[$i]['nombre']; ?></td>
                    <td><?php echo '$'.$results->data[$i]['precio']; ?></td>
                    <td><?php echo $results->data[$i]['artista']; ?></td>
                    <td><img src="<?php echo $results->data[$i]['imagen'] ?>" alt="miniatura" width="100px"></td>
                    </tr>
                    <?php endfor; ?>
                    
                    </tbody>
                  </table>
        <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 
      </div>
    </div>
  </div>

  <div class="container-fluid" id="terceraSeccion">
    <div class="row">
      <div class="col">
        <img src="./images/ecos-logo.png" id="logo-blanco" width="150px">
        <br>
        <br>
        <a href="https://www.facebook.com/aconcaguauniversidad"><img src="./images/facebook.svg" id="icono-fb" width="47px"></a>
        <a href="https://twitter.com/aconcagua1965"><img src="./images/twitter.svg" id="icono-tw" width="47px"></a>
        <a href="https://www.instagram.com/universidaddelaconcagua/"><img src="./images/instagram.svg" id="icono-ig" width="47px"></a>
      </div>
      <div class="col">
        <button type="submit" class="btn btn-secondary mb-2">Tema Oscuro</button>
        <br>
        <br>
        <a href="login.html" id="enlaceCRUD">Iniciar sesión como administrador.</a>
      </div>
    </div>
  </div>

  <footer>
    <p class="attribution">
      Coded by <a href="https://www.github.com/smoran24">Sebastián Alejandro Morán</a>.
    </p>
  </footer>
</body>
</html>