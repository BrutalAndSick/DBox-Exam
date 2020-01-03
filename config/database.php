<?php

/********************
 * Clase clsDatabase
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 *********************/
class clsDatabase
{

    /** Credenciales de acceso a la Base de Datos **/
    private $strHost = "localhost";
    private $strDBName = "digibox";
    private $strUser = "root";
    private $strPass = "";

    public $objConn;

    public function getConnection()
    {
        /********************
         * Método getConnection
         * Autor GONZALO MORALES
         * Fecha de Creación 2020-01-02
         * Parametros de entrada NINGUNO
         * Devuelve OBJETO DE CONEXION A BASE DE DATOS
         *********************/

        $this->objConn = null;

        try {
            $this->objConn = new PDO("mysql:host=" . $this->strHost . ";dbname=" . $this->strDBName, $this->strUser, $this->strPass);
            $this->objConn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->objConn;
    }
}