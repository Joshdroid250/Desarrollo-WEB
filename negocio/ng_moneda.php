<?php
include_once("../entidades/moneda.php");
include_once("../datos/dt_moneda.php");

$cp = new Moneda();
$dtcp = new Dt_moneda();

if ($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
        try
        {
          
            $cp->__SET('nombre',$_POST['nombre']);
            $cp->__SET('simbolo',$_POST['simbolo']);
            $cp->__SET('estado', '1');

            $dtcp->registrarMoneda($cp);
            header("Location: ../pages/catalogos/tbl_moneda.php?msj=1");
        }
        catch(Exception $e) {
            header("Location: ../pages/catalogos/tbl_moneda.php?msj=2");
            die($e->getMessage());
        }
        break;

        case '2': 
            try{
               
            $cp->__SET('nombre',$_POST['nombre']);
            $cp->__SET('simbolo',$_POST['simbolo']);
            $cp->__SET('estado','2');

            $dtcp->editMoneda($cp);
            header ("Location: ../pages/catalogos/tbl_moneda.php?msj=3 "); 
            }
            catch(Exception $e) {
                header("Location: ../pages/catalogos/tbl_moneda.php?msj=4");
                die($e->getMessage());
            }
            break;
            default:
            break;
    }
}

if ($_GET)
{
    try{
        $cp->__SET('id_moneda', $_GET['del']);
        $dtcp->borrarMoneda($cp->__GET('id_moneda'));
        header("Location: ../pages/catalogos/tbl_moneda.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location: ../pages/catalogos/tbl_moneda.php?msj=6");
        die($e->getMessage());
    }
    
}
