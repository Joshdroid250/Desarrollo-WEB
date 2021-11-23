<?php
include_once("../entidades/categoria_productos.php");
include_once("../datos/dt_categoria_productos.php");

$cp = new CategoriaP();
$dtcp = new Dt_categoria_productos();

if ($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
        try
        {
          
            $cp->__SET('nombre',$_POST['nombre']);
            $cp->__SET('descripcion',$_POST['descripcion']);
            $cp->__SET('estado', '1');

            $dtcp->registrarCategoriaP($cp);
            header("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=1");
        }
        catch(Exception $e) {
            header("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=2");
            die($e->getMessage());
        }
        break;

        case '2': 
            try{
               
            $cp->__SET('nombre',$_POST['nombre']);
            $cp->__SET('descripcion',$_POST['descripcion']);
            $cp->__SET('estado','2');

            $dtcp->editCategoriap($cp);
            header ("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=3 "); 
            }
            catch(Exception $e) {
                header("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=4");
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
        $cp->__SET('id_categoria_producto', $_GET['del']);
        $dtcp->borrarCategoriaP($cp->__GET('id_categoria_producto'));
        header("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location: ../pages/catalogos/tbl_categoria_productos.php?msj=6");
        die($e->getMessage());
    }
    
}
