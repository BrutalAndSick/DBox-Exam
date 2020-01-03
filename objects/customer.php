<?php

/********************
 * Clase clsCustomer
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 *********************/
class clsCustomer
{

    /** Encabezados Privadas **/
    private $objConn;
    private $strTableName = "tblCustomer";

    /** Propiedades Publicas **/
    public $intCustomerId;
    public $strCustomerName;
    public $strXML;

    // Constructor with $objDB as database connection
    public function __construct($objDB)
    {
        /** Constructor con conexion a la base de datos **/
        $this->objConn = $objDB;
    }

    function readCustomer()
    {
        /********************
         * Método readCustomer
         * Autor GONZALO MORALES
         * Fecha de Creación 2020-01-02
         * Parametros de entrada NINGUNO
         * Devuelve RECORDSET DE CONSULTA DE CLIENTES
         *********************/

        $strSql = "SELECT intCustomerId, strCustomerName FROM " . $this->strTableName;

        $stmtSQL = $this->objConn->prepare($strSql);

        $stmtSQL->execute();

        return $stmtSQL;
    }

    function createCustomer()
    {
        /********************
         * Método createCustomer
         * Autor GONZALO MORALES
         * Fecha de Creación 2020-01-02
         * Parametros de entrada NINGUNO
         * Devuelve INSERTA CLIENTE SOLICITADO
         *********************/

        $strSql = "INSERT INTO " . $this->strTableName . " SET strCustomerName=:strCustomerName";

        $stmtSQL = $this->objConn->prepare($strSql);

        $this->strCustomerName = htmlspecialchars(strip_tags($this->strCustomerName));

        $stmtSQL->bindParam(":strCustomerName", $this->strCustomerName);

        if ($stmtSQL->execute()) {
            $this->intCustomerId = $this->objConn->lastInsertID();
            return true;
        }

        $this->intCustomerId = 0;
        return false;
    }

    function searchCustomer()
    {
        /********************
         * Método searchCustomer
         * Autor GONZALO MORALES
         * Fecha de Creación 2020-01-02
         * Parametros de entrada NINGUNO
         * Devuelve RECORDSET DEL CLIENTE SOLICITADO
         *********************/
        $strSql = "SELECT intCustomerId, strCustomerName FROM " . $this->strTableName . " WHERE intCustomerId=:intCustomerId";

        $stmtSQL = $this->objConn->prepare($strSql);

        $stmtSQL->bindParam(":intCustomerId", $this->intCustomerId);

        $stmtSQL->execute();

        return $stmtSQL;
    }

    function buildXML()
    {
        /********************
         * Método buildXML
         * Autor GONZALO MORALES
         * Fecha de Creación 2020-01-02
         * Parametros de entrada NINGUNO
         * Devuelve XML CONSTRUIDO
         *********************/
        $xmlResponse = new XMLWriter();
        $xmlResponse->openMemory();
        $xmlResponse->setIndent(true);
        $xmlResponse->setIndentString('	');
        $xmlResponse->startDocument('1.0', 'utf-8');
        $xmlResponse->startElement("CamposAdicionales");
        $xmlResponse->writeAttribute('xmlns', 'http://www.digibox.com.mx/cfdi/camposadicionales');
        $xmlResponse->writeAttribute('xsi:schemaLocation', 'http://www.digibox.com.mx/cfdi/camposadicionales schema.xsd');
        $xmlResponse->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xmlResponse->startElement("CampoAdicional");
        $xmlResponse->writeAttribute('nombre', $this->strCustomerName);
        $xmlResponse->writeAttribute('valor', $this->intCustomerId);
        $xmlResponse->endElement();
        $xmlResponse->endElement();
        $this->strXML = $xmlResponse->outputMemory();

        $objXML = new DOMDocument();
        $objXML->loadXML($this->strXML, LIBXML_NOBLANKS);
        if ($objXML->schemaValidate('https://aplicacion.digibox.com.mx/addenda/camposadicionales.xsd')) {
            return true;
        }

        $this->strXML = '';
        return false;
    }
}