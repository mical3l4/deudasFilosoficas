create database prueba1;
create table usuario (
id int primary key not null auto_increment,
nombre varchar(230),
apellido varchar(250),
usuario varchar(250),
contrasenha text,
correo text
);
select * from usuario; 

create table inicio_sesion (
id INT auto_increment primary key,
correo text,
contrasenha varchar(255) not null
);