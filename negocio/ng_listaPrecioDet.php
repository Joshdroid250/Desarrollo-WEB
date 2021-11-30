<?php
//error_reporting(0);

include_once('../entidades/listaprecio_det.php');
include_once('../datos/dt_lista_preciodet.php');


$listaDet = new ListaPrecioDet();
$dtLista = new dt_lista_preciodet();

if ($_POST) {
    $varAccion = $_POST['txtaccion'];
    switch ($varAccion) {
        case '1':
            try {
                $listaDet->__SET('id_listaprecio_det', $_POST['id_listaprecio_det']);
                $listaDet->__SET('id_lista_precio', $_POST['id_lista_precio']);
                $listaDet->__SET('id_producto', $_POST['id_producto']);
                $listaDet->__SET('precio_venta', $_POST['precio_venta']);

                $dtLista->regListaPrecioDet($listaDet);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=1");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=2 ");
            }
            break;
        case '2':
            try {
                $listaDet->__SET('id_listaprecio_det', $_POST['id_listaprecio_det']);
                $listaDet->__SET('id_lista_precio', $_POST['id_lista_precio']);
                $listaDet->__SET('id_producto', $_POST['id_producto']);
                $listaDet->__SET('precio_venta', $_POST['precio_venta']);
                $dtLista->editListaPrecioDet($listaDet);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=3");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=4 ");
            }
            break;
    }
}

    if ($_GET) {
        try {
            $listaDet->__SET('id_listaprecio_det', $_GET['delDet']);
            $dtLista->deleteList($listaDet->__GET('id_listaprecio_det'));
    
            header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaPrecio.php?msj=5");
        } catch (Exception $e) {
            header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaPrecio.php?msj=6 ");
        }
    }
