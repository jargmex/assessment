Jose Alfredo Rendon Garcia
jargmex@hotmail.com
Programador php
    Java: 50%
    Javascript: 50%
    PHP: 80%
    C++: 40%
Assessment nivel intermedio

Creación de la base de datos:
    nivel basico: todas las actividades
    nivel intermedio: todas las actividades
    nivel avanzado: apartado 2 procedimiento almacenado
ARCHIVO DE CONFIGURACIÓN 
COMUNICACIÓN PHP CON LA BASE DE DATOS
    nivel basico: todas la actividades
    nivel intermedio: todas las actividades
    nivel avanzado: apartado 1 dividir productos en 3 categorias
CARPETA PUBLIC_HTML
    creacion de archivo .htaccess
    nivel basico: todas la actividades
    nivel intermedio: todas las actividades


1.- Ejecutar el script que esta en la carpeta install/ScriptBD.txt en orden como van apareciendo las consultas SQL
2.- Configurar el archivo para la conexion a base de datos: install/conexion.php:
    En las primeras lines del archivo cambiar los valores de la variables:
        define('HOST', 'localhost'); dominio o ip de servidor donde esta el servicio de php
        define('USER', 'root');  nombre del usurio para acceso a la base de datos
        define('PASSWORD', ''); contraseña para el acceso a la base de datos
        define('DATABASE', 'assessment'); nombre de la base de datos creada anterior mente con el script
3.- Para evitar problemas con los vinculos para navegacion o las imagen se sugiere la siguente estructura:
    En la carpeta del hostlocal o servidor, donde se encuenta el servidor de php el directorio debe tener el siguente orden:
        Assessment
            install
            php
                control
                modelo
            public_html
                css
                fonts
                imagen
                js
4.- Se puede visualizar una pagina index de navegacion para ejecutar las funciones php, ejemplo:
    http://localhost/assessment/ se accede al menu creado en el index