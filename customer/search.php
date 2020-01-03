<?php
/********************
 * Endpoint search.php
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 * URL http://<dominio>/<proyecto>/customer/search.php
 * Parametros de entrada JSON CON DATOS DE CLIENTE A BUSCAR
 * Estructura JSON de entrada { "CustomerId" : "" }
 * Método de entrada POST
 * Devuelve XML DEL CLIENTE BUSCADO
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
if (!empty($postData->CustomerId)) {

    /** Asignar propiedades del objeto customer **/
    $objCustomer->intCustomerId = $postData->CustomerId;

    /** Buscar Cliente **/
    $stmtCustomer = $objCustomer->searchCustomer();
    $intRowCount = $stmtCustomer->rowCount();

    /** Verificar existencia de datos **/
    if ($intRowCount > 0) {

        /** Volcar datos en propiedades del objeto customer **/
        while ($rowCustomer = $stmtCustomer->fetch(PDO::FETCH_ASSOC)) {
            extract($rowCustomer);
            $objCustomer->strCustomerName = html_entity_decode($strCustomerName);
        }

        /** Construir XML **/
        if ($objCustomer->buildXML()) {

            /** Respuesta HTTP - 200 OK **/
            http_response_code(201);

            /** Devolver XML al usuario **/
            echo $objCustomer->strXML;
        } /** Informar al usuario que no se creo el XML**/
        else {

            /** Respuesta HTTP - 503 Service Unavailable **/
            http_response_code(503);

            /** Informar al usuario que no se logro crear el XML **/
            echo json_encode(array("err_message" => "Ocurrio un error al crear el XML"));
        }

    } /** Informar al usuario que no se encontro el cliente buscado **/
    else {

        /** Respuesta HTTP - 404 Not Found **/
        http_response_code(404);

        /** Informar al usuario que no se encontraron datos **/
        echo json_encode(array("err_message" => "No se encontro el cliente"));
    }

} /** Informar al usuario que los datos de entrada son incorrectos **/
else {

    /** Respuesta HTTP - 400 Bad Request **/
    http_response_code(400);

    /** Informar al usuario que no se logro insertar el registro, datos vacios **/
    echo json_encode(array("err_message" => "Datos vacios"));
}