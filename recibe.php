<?php  

$_FILES['archivo']['tmp_name']; //Nombre que ha recibido el archivo en el servidor de manera temporal
$_FILES['archivo']['name']; //Nombre del archivo enviado
$_FILES['archivo']['size']; //Tamaño en bytes
$_FILES['archivo']['type']; //Tipo del archivo
$_FILES['archivo']['error']; //Error devuelto al subir el archivo

$tam_max = 1048576;
if(is_uploaded_file($_FILES['archivo']['tmp_name'])) {
    if($_FILES['archivo']['size'] > $tam_max) {
         unlink($_FILES['archivo']['tmp_name']);
         echo "<script> alert('El archivo es demasiado grande') </script>";
    } else {
         if($_FILES['archivo']['type'] == "image/gif"
         OR $_FILES['archivo']['type'] == "image/pjpeg"
         OR $_FILES['archivo']['type'] == "image/jpeg"
         OR eregi("(.php)$", $_FILES['archivo']['name'])
         OR eregi("(.php3)$", $_FILES['archivo']['name'])
         OR eregi("(.php4)$", $_FILES['archivo']['name'])
         OR eregi("(.phtml)$", $_FILES['archivo']['name'])) {
              echo "<script> alert('Tipo de archivo no permitido') </script>";
              unlink($_FILES['archivo']['tmp_name']);
         } else {
              if(strstr($_FILES['archivo']['name'], '..')) {
                   echo "<script> alert ('Acción no permitida') </script>";
              } else {
                   echo "<script> alert('El archivos se subio de manera correcta') </script>";
                   move_uploaded_file($_FILES['archivo']['tmp_name'], "uploads/{$_FILES['archivo']['name']}");
                   unlink($_FILES['archivo']['tmp_name']);
              }
         }
    }
} else {
    echo "<script> alert('Ha ocurrido un error al subir el archivo') </script>";
    //Comprobar $_FILES['archivo']['error']
} ?>
