<?php
/*base: u178928053_deudasf
usuario: u178928053_jimena
contraseña: =T2NspU#r6I*/


$conexion= new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");

$sql = "create table usuario (
    id int primary key not null auto_increment,
    nombre varchar(230),
    apellido varchar(250),
    usuario varchar(250),
    contrasenha text,
    correo text
);
";

$conexion->query(query: $sql);

$sql = "create table inicio_sesion (
    id INT auto_increment primary key not null,
    correo text,
    contrasenha varchar(255) not null
    );
";

$conexion->query(query: $sql);

$sql ="CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenido TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nombre_imagen VARCHAR(255)
);"
;
$conexion->query(query: $sql);

