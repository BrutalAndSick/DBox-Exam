<?php
/********************
 * Endpoint read.php
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 * URL http://<dominio>/<proyecto>/customer/read.php
 * Parametros de entrada NINGUNO
 * Devuelve JSON CON EL CONTENIDO DE LA TABLA tblCustomer
 *********************/

/** Encabezados Requeridos **/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/** Incluir Objetos - REQUERIDO **/
include_once '../config/database.php';
include_once '../objects/customer.php';

/** Instaciar e inicializar objetos **/
$objDatabase = new clsDatabase();
$objDB = $objDatabase->getConnection();
$objCustomer = new clsCustomer($objDB);

/** Consultar clientes **/
$stmtCustomer = $objCustomer->readCustomer();
$intRowCount = $stmtCustomer->rowCount();

/** Verificar existencia de datos **/
if ($intRowCount > 0) {

    /** Crear arreglo base de trabajo **/
    $arrCustomer = array();
    $arrCustomer["customers"] = array();

    /** Volcar datos en el arreglo **/
    while ($rowCustomer = $stmtCustomer->fetch(PDO::FETCH_ASSOC)) {
        extract($rowCustomer);

        $itemCustomer = array(
            "CustomerId" => $intCustomerId,
            "CustomerName" => html_entity_decode($strCustomerName)
        );

        array_push($arrCustomer["customers"], $itemCustomer);
    }

    /** Respuesta HTTP - 200 OK **/
    http_response_code(200);

    /** Devolver JSON al usuario **/
    echo json_encode($arrCustomer);
} /** informar al usuario que no hay datos**/
else {
    /** Respuesta HTTP - 404 Not Found **/
    http_response_code(404);

    /** Informar al usuario que no se encontraron datos **/
    echo json_encode(array("strMessage" => "No customers found."));
}