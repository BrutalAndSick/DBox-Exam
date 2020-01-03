# DBox-Exam
Examen Técnico para aplicar al puesto de Líder de TI en DigiBox / Technical Exam to apply for the position of IT Leader in DigiBox

Construido usando:
  Windows 7 Pro 64 bit
  WAMPSERVER 3.2.0
    Apache 2.4.41
    PHP 7.3.12
    MySQL 8.0.18
    
Requerimientos especiales:
  Ninguno

Instalacion:
  Crear proyecto directorio de proyecto en el root del webserver
  Ejecutar config/database.sql en la Base de Datos
  Ingresar credenciales de la base de datos en config/database.php
  
Ejectuar (se recomienda postman para test):
  Endpoint1 http://<dominio>/<proyecto>/customer/read.php
    * No requiere parametros POST
  Endpoint2 http://<dominio>/<proyecto>/customer/create.php
    * POST JSON { "CustomerName" : "<Nombre del cliente a insertar>" }
  Endpoint3 http://<dominio>/<proyecto>/customer/search.php
    * POST JSON { "CustomerId" : "<Id del cliente a consultar>" }
