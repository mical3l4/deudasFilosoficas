<?php
require_once("conexion.php");
$id=$_POST['id'];
$sql="delete from usuario where id=".$id;
$query=$con->query($sql);

if ($query==1){
    echo "Usuario borrado."
}