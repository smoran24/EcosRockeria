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
  <link href="./css/style.css" rel="stylesheet"> <!-- mis estilos-->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <title>Ecos Rockería - Búsqueda</title>
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
          <form method="POST">
            <div class="form-row align-items-center">
              <div class="col-auto">
                <input required name="PalabraClave" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Buscar artículos...">  
                <input name="buscar" type="hidden" class="form-control mb-2" id="inlineFormInput" value="v">
              </div>
              <div class="col-auto">
                <select class="form-select" name="filtrado" id="filtrado">
                  <option selected value="nom">Filtrar por nombre</option>
                  <option value="cat">Filtrar por categoría</option>
                  <option value="art">Filtrar por artista</option>
                </select>
                <br>
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

                    <?php
                    $opcion=$_REQUEST['filtrado']; //$_REQUEST almacena el valor de la opción seleccionada del select.
                    if(isset($opcion)){ //verifica si hay algo seleccionado:
                      if($opcion == 'cat'){ //si se filtró por categoría...
                        if(!empty($_POST)){ //logica php para mostrar resultados de busqueda
                          $aKeyword = explode(" ", $_POST['PalabraClave']); //convierte en array la string de palabras clave
                          $query ="SELECT * FROM productos WHERE categoria like '%" . $aKeyword[0] . "%'"; //introduce el indice 0 del array de palabras clave en el query
                          for($i = 1; $i < count($aKeyword); $i++) {
                            if(!empty($aKeyword[$i])) {
                              $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
                            }
                          }
                        }
                      }else if($opcion == 'nom'){ //si se filtró por nombre...
                        if(!empty($_POST)){ //logica php para mostrar resultados de busqueda
                          $aKeyword = explode(" ", $_POST['PalabraClave']); //convierte en array la string de palabras clave
                          $query ="SELECT * FROM productos WHERE nombre like '%" . $aKeyword[0] . "%'"; //introduce el indice 0 del array de palabras clave en el query
                          for($i = 1; $i < count($aKeyword); $i++) {
                            if(!empty($aKeyword[$i])) {
                              $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
                            }
                          }
                        }
                      }else if($opcion == 'art'){ //si se filtró por artista...
                        if(!empty($_POST)){ //logica php para mostrar resultados de busqueda
                          $aKeyword = explode(" ", $_POST['PalabraClave']); //convierte en array la string de palabras clave
                          $query ="SELECT * FROM productos WHERE artista like '%" . $aKeyword[0] . "%'"; //introduce el indice 0 del array de palabras clave en el query
                          for($i = 1; $i < count($aKeyword); $i++) {
                            if(!empty($aKeyword[$i])) {
                              $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
                            }
                          }
                        }
                      }
                      $db = conectar(); //asigna a la variable db la conexion a base de datos
                      $result = $db->query($query); //asigna a variable result la sentencia sql
                      echo "Has buscado por:<b> ". $_POST['PalabraClave']."</b>";            
                      if(mysqli_num_rows($result) > 0) { //si el numero de filas obtenidos con la sentencia sql es mayor a 0...
                        $row_count=0;
                        echo "<br>Resultados encontrados: ";
                        echo "<br><table class='table table-striped table-condensed table-bordered table-rounded'>";
                        While($row = $result->fetch_assoc()) {   
                          $row_count++;                         
                          echo "<tr><td>". $row['categoria'] . "</td><td>". $row['nombre'] . "</td><td>$". $row['precio'] ."</td><td>". $row['artista'] ."</td><td><img src='". $row['imagen'] ."' alt='miniatura' width='100px'></td></tr>";
                        }
                        echo "</table>";
                      }
                      else {
                        echo "<br>Resultados encontrados: Ninguno";
                      }
                    }else{ //sino hace la búsqueda global (muestra todos los resultados)
                      if(!empty($_POST)){ //logica php para mostrar resultados de busqueda
                        $aKeyword = explode(" ", $_POST['PalabraClave']); //convierte en array la string de palabras clave
                        $query ="SELECT * FROM productos WHERE categoria like '%" . $aKeyword[0] . "%' OR nombre like '%" . $aKeyword[0] . "%'"; //introduce el indice 0 del array de palabras clave en el query
                        for($i = 1; $i < count($aKeyword); $i++) {
                          if(!empty($aKeyword[$i])) {
                            $query .= " OR nombre like '%" . $aKeyword[$i] . "%'";
                          }
                        }
                        $db = conectar(); //asigna a la variable db la conexion a base de datos
                        $result = $db->query($query); //asigna a variable result la sentencia sql
                        echo "Has buscado:<b> ". $_POST['PalabraClave']."</b>";            
                        if(mysqli_num_rows($result) > 0) { //si el numero de filas obtenidos con la sentencia sql es mayor a 0...
                          $row_count=0;
                          echo "<br>Resultados encontrados: ";
                          echo "<br><table class='table table-striped table-condensed table-bordered table-rounded'>";
                          While($row = $result->fetch_assoc()) {   
                            $row_count++;                         
                            echo "<tr><td>". $row['categoria'] . "</td><td>". $row['nombre'] . "</td><td>$". $row['precio'] ."</td><td>". $row['artista'] ."</td><td><img src='". $row['imagen'] ."' alt='miniatura' width='100px'></td></tr>";
                          }
                          echo "</table>";
                        }
                        else {
                          echo "<br>Resultados encontrados: Ninguno";
                        }
                      }
                    }
                  ?>

                    </tbody>
                  </table>
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