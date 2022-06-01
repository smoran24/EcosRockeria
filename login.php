
<?php
  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
   
  // Esto se puede remplazar por un usuario real guardado en la base de datos.
  if($email == 'admin@root.com' && $password == '2515'){
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    //creo la cookie guardando solo el email de la sesion
    $cookie_name = "login";
    $cookie_value = $email;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 dia, "/" significa que la cookie esta disponible en toda la pagina
     
    // Redirecciono al usuario a la página principal del CRUD.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: productos.php"); 
  }else{
    echo 'Los datos son incorrectos, <a href="login.html">vuelva a intentarlo</a>.<br/>';
  }
 
?>