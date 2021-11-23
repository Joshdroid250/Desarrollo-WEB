<?php
//error_reporting(0);

include_once('../entidades/kermesse.php');
include_once('../datos/dt_kermesse.php');


$kerme = new kermesse();
$dtKerme = new dt_kermesse();
date_default_timezone_set("America/Managua");

if ($_POST) {
    $varAccion = $_POST['txtaccion'];
    switch ($varAccion) {
        case '1':
            try {
                $kerme->__SET('id_kermesse', $_POST['id_kermesse']);
                $kerme->__SET('idParroquia', $_POST['idParroquia']);
                $kerme->__SET('nombre', $_POST['nombre']);
                $kerme->__SET('fInicio', $_POST['fInicio']);
                $kerme->__SET('fFinal', $_POST['fFinal']);
                $kerme->__SET('descripcion', $_POST['descripcion']);
                $kerme->__SET('estado', 1);
                $kerme->__SET('usuario_creacion', 1);
                $kerme->__SET('fecha_creacion', date("Y-m-d H:i:s"));
                $dtKerme->regKermesse($kerme);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=1");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=2 ");
            }
            break;
        case '2':
            try {
                $kerme->__SET('id_kermesse', $_POST['id_kermesse']);
                $kerme->__SET('idParroquia', $_POST['idParroquia']);
                $kerme->__SET('nombre', $_POST['nombre']);
                $kerme->__SET('fInicio', $_POST['fInicio']);
                $kerme->__SET('fFinal', $_POST['fFinal']);
                $kerme->__SET('descripcion', $_POST['descripcion']);
                $kerme->__SET('estado', 2);
                $kerme->__SET('usuario_modificacion', 1);
                $kerme->__SET('fecha_modificacion', date("Y-m-d H:i:s"));
                
                $dtKerme->editKerme($kerme);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=3");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=4 ");
            }
            break;
    }
}

if ($_GET) {
    try {
        $kerme->__SET('id_kermesse', $_GET['delKer']);
        $dtKerme->deleteKerme($kerme->__GET('id_kermesse'));

        header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=5");
    } catch (Exception $e) {
        header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_kermesse.php?msj=6 ");
    }
}