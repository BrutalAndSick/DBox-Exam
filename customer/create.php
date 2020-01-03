<?php
/********************
 * Endpoint create.php
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 * URL http://<dominio>/<proyecto>/customer/create.php
 * Parametros de entrada JSON CON DATOS DE CLIENTE A INSERTAR
 * Estructura JSON de entrada { "CustomerName" : "" }
 * Método de entrada POST
 * Devuelve JSON CON EL ID DEL CLIENTE INSERTADO
 * Estructra JSON de salida { "CustomerId" : "" }
 *********************/

/** Encabezados Requeridos **/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/** Incluir Objetos - REQUERIDO **/
include_once '../config/database.php';
include_once '../objects/customer.php';

/** Instaciar e inicializar objetos **/
$objDatabase = new clsDatabase();
$objDB = $objDatabase->getConnection();
$objCustomer = new clsCustomer($objDB);

/** Obtener datos POST **/
$postData = json_decode(file_get_contents("php://input"));

/** Validar datos no vacios **/
if (!empty($postData->CustomerName)) {

    /** Asignar propiedades del objeto customer **/
    $objCustomer->strCustomerName = $postData->CustomerName;

    /** Insertar el cliente **/
    if ($objCustomer->createCustomer()) {

        /** Respuesta HTTP - 200 OK **/
        http_response_code(201);

        /** Devolver JSON al usuario **/
        echo json_encode(array("CustomerId" => $objCustomer->intCustomerId ));

    } /** Si ocurrio un error al insertar informar al usuario **/
    else {

        /** Respuesta HTTP - 503 Service Unavailable **/
        http_response_code(503);

        /** Informar al usuario que no se logro insertar el registro **/
        echo json_encode(array("err_message" => "Ocurrio un error al insertar el cliente"));
    }
} /** Informar al usuario que los datos de entrada son incorrectos **/
else {

    /** Respuesta HTTP - 400 Bad Request **/
    http_response_code(400);

    /** Informar al usuario que no se logro insertar el registro, datos vacios **/
    echo json_encode(array("err_message" => "Datos vacios"));
}