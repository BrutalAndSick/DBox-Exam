/********************
 * Script CONSTRUCCION DE BASE DE DATOS
 * Autor GONZALO MORALES
 * Fecha de Creación 2020-01-02
 *********************/

/* Esquema - Requerido */
CREATE SCHEMA `digibox` DEFAULT CHARACTER SET utf8 ;

/* Tabla - Requerido */
CREATE TABLE `digibox`.`tblCustomer` (
  `intCustomerId` INT NOT NULL AUTO_INCREMENT COMMENT 'Customer Id, int, not null, auto increment, table primary key',
  `strCustomerName` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL COMMENT 'Customer Name, Varchar 255 length, not null',
  PRIMARY KEY (`intCustomerId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tabla para almacenar datos basicos de clientes';

/* Poblar tabla con datos de prueba - Opcional */
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (1, 'Jack Skellington');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (2, 'Jack Frost');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (3, 'Jack Bauer');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (4, 'Jack Sparrow');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (5, 'Jack Torrance');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (6, 'Jack Reacher');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (7, 'Jack Ripper');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (8, 'Jack McCoy');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (9, 'Jack Rafferty');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (10, 'Jack Crow');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (11, 'Jack Burrell');
INSERT INTO tblcustomer (intCustomerId, strCustomerName) VALUES (12, 'Jack Travis');