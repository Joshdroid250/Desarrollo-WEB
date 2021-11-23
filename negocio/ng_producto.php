<?php
include_once("../entidades/productos.php");
include_once("../datos/dt_productos.php");

$cp = new Productos();
$dtcp = new Dt_productos();

if ($_POST)
{
    $varAccion = $_POST['txtaccion'];

    switch($varAccion)
    {
        case '1':
        try
        {
          
            $cp->__SET('id_comunidad',$_POST['id_comunidad']);
            $cp->__SET('id_cat_producto',$_POST['id_cat_producto']);
            $cp->__SET('nombre',$_POST['nombre']);
            $cp->__SET('descripcion',$_POST['descripcion']);
            $cp->__SET('cantidad',$_POST['cantidad']);
            $cp->__SET('preciov_sugerido',$_POST['preciov_sugerido']);
            $cp->__SET('estado',$_POST['estado']);

            $dtcp->registrarPorducto($cp);
            header("Location: ../pages/catalogos/tbl_productos.php?msj=1");
        }
        catch(Exception $e) {
            header("Location: ../pages/catalogos/tbl_productos.php?msj=2");
            die($e->getMessage());
        }
        break;
        case '2': 
            try{
                
                $cp->__SET('id_comunidad',$_POST['id_comunidad']);
                $cp->__SET('id_cat_producto',$_POST['id_cat_producto']);
                $cp->__SET('nombre',$_POST['nombre']);
                $cp->__SET('descripcion',$_POST['descripcion']);
                $cp->__SET('cantidad',$_POST['cantidad']);
                $cp->__SET('preciov_sugerido',$_POST['preciov_sugerido']);
                $cp->__SET('estado',$_POST['estado']);

            $dtcp->editProducto($cp);
            header ("Location: ../pages/catalogos/tbl_productos.php?msj=3 "); 
            }
            catch(Exception $e) {
                header("Location: ../pages/catalogos/tbl_productos.php?msj=4");
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
        $p->__SET('id_categoria_producto', $_GET['del']);
        $dtp->borrarP($p->__GET('id_categoria_producto'));
        header("Location: ../pages/catalogos/tbl_productos.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location: ../pages/catalogos/tbl_productos.php?msj=6");
        die($e->getMessage());
    }
    
}
