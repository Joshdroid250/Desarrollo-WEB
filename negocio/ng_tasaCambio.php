<?php
include_once("../entidades/tasaCambio.php");
include_once("../datos/dt_tasaCambio.php");

$cp = new TasaCambio();
$dtcp = new Dt_tasacambio();

if ($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
        try
        {
          
            $cp->__SET('id_monedaO',$_POST['id_monedaO']);
            $cp->__SET('id_monedaC',$_POST['id_monedaC']);
            $cp->__SET('mes',$_POST['mes']);
            $cp->__SET('anio',$_POST['anio']);
            $cp->__SET('estado',$_POST['estado']);

            $dtcp->registrarTc($cp);
            header("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=1");
        }
        catch(Exception $e) {
            header("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=2");
            die($e->getMessage());
        }
        break;
        case '2': 
            try{
                
                $cp->__SET('id_monedaO',$_POST['id_monedaO']);
                $cp->__SET('id_monedaC',$_POST['id_monedaC']);
                $cp->__SET('mes',$_POST['mes']);
                $cp->__SET('anio',$_POST['anio']);
                $cp->__SET('estado',$_POST['estado']);

            $dtcp->editTc($cp);
            header ("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=3 "); 
            }
            catch(Exception $e) {
                header("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=4");
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
        $cp->__SET('id_tasaCambio', $_GET['del']);
        $dtcp->borrarTc($cp->__GET('id_tasaCambio'));
        header("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location: ../pages/catalogos/tbl_tasaCambio.php?msj=6");
        die($e->getMessage());
    }
    
}