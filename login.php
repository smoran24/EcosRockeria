
<?php
  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
   
  // Esto se puede remplazar por un usuario real guardado en la base de datos.
  if($email == 'admin@ecos.com' && $password == '2515'){
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
     
    // Redirecciono al usuario a la página principal del sitio.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: mostrar-producto.php"); 
  }else{
    echo 'El email o password es incorrecto, <a href="login.html">vuelva a intenarlo</a>.<br/>';
  }
 
?>