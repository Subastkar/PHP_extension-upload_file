<?php  

$_FILES['file']['tmp_name']; //Nombre que ha recibido el archivo en el servidor de manera temporal
$_FILES['file']['name']; //Nombre del archivo enviado
$_FILES['file']['size']; //Tamaño en bytes
$_FILES['file']['type']; //Tipo del archivo
$_FILES['file']['error']; //Error devuelto al subir el archivo

$tam_max = 10485760;
if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    if($_FILES['file']['size'] > $tam_max) {
         unlink($_FILES['file']['tmp_name']);
         echo("<script> alert ('El archivo es demasiado grande') </script>");
    } else {
         if($_FILES['file']['type'] == "image/gif"
         OR $_FILES['file']['type'] == "image/pjpeg"
         OR $_FILES['file']['type'] == "image/jpeg"
         OR eregi("(.php)$", $_FILES['file']['name'])
         OR eregi("(.php3)$", $_FILES['file']['name'])
         OR eregi("(.php4)$", $_FILES['file']['name'])
         OR eregi("(.phtml)$", $_FILES['file']['name'])) {
              echo ("<script> alert ('Tipo de archivo no permitido') </script>");
              unlink($_FILES['file']['tmp_name']);
         } else {
              if(strstr($_FILES['file']['name'], '..')) {
                   echo ("Acción no permitida");
              } else {
                   echo ("<script> alert ('El archivos se subio de manera correcta') </script>");
                   move_uploaded_file($_FILES['file']['tmp_name'], "/var/www/uploads/{$_FILES['file']['name']}");
                   unlink($_FILES['file']['tmp_name']);
              }
         }
    }
} else {
    echo ("<script> alert ('Ha ocurrido un error al subir el archivo') </script>");
} ?>
