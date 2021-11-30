<?php
include_once("../entidades/rol.php");
include_once("../datos/dt_rol.php");

$cp = new Rol();
$dtcp = new Dt_rol();

if ($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
        try
        {
            
            $cp->__SET('rol_descripcion',$_POST['rol_descripcion']);
            $cp->__SET('estado','1');

            $dtcp->registrarRol($cp);
            header("Location: ../pages/catalogos/tbl_rol.php?msj=1");
        }
        catch(Exception $e) {
            header("Location: ../pages/catalogos/rol.php?msj=2");
         
        }
        
        break;
    

        case '2': 
            try{

                $cp->__SET('id_rol',$_POST['id_rol']);
            $cp->__SET('rol_descripcion',$_POST['rol_descripcion']);
            $cp->__SET('estado','2');

            $dtcp->editRol($cp);
            header ("Location: ../pages/catalogos/tbl_rol.php?msj=3 "); 
            }
            catch(Exception $e) {
                header("Location: ../pages/catalogos/tbl_rol.php?msj=4");
          
            }
            break;
            default:
            break;

    }
}

if ($_GET)
{
    try{
        $cp->__SET('id_rol', $_GET['del']);
        $dtcp->borrarRol($cp->__GET('id_rol'));
        header("Location: ../pages/catalogos/tbl_rol.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location: ../pages/catalogos/tbl_rol.php?msj=6");
        die($e->getMessage());
    }
    
}