<?php
//error_reporting(0);

include_once('../entidades/lista_precio.php');
include_once('../datos/dt_listaPrecio.php');


$lista = new ListaPrecio();
$dtLista = new dt_ListaPrecio();

if ($_POST) {
    $varAccion = $_POST['txtaccion'];
    switch ($varAccion) {
        case '1':
            try {
                $lista->__SET('id_lista_precio', $_POST['id_lista_precio']);
                $lista->__SET('id_kermesse', $_POST['id_kermesse']);
                $lista->__SET('nombre', $_POST['nombre']);
                $lista->__SET('descripcion', $_POST['descripcion']);
                $lista->__SET('estado', 1);
                $dtLista->regListaPrecio($lista);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=1");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=2 ");
            }
            break;
        case '2':
            try {                
                $lista->__SET('id_lista_precio', $_POST['id_lista_precio']);
                $lista->__SET('id_kermesse', $_POST['id_kermesse']);
                $lista->__SET('nombre', $_POST['nombre']);
                $lista->__SET('descripcion', $_POST['descripcion']);
                $lista->__SET('estado', 2);
                $dtLista->editListaPrecio($lista);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=3");
            } catch (Exception $e) {
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=4 ");
            }
            break;
    }
}

if ($_GET) {
    try {
        $lista->__SET('id_lista_precio', $_GET['delL']);
        $dtLista->deleteLista($lista->__GET('id_lista_precio'));

        header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=5");
    } catch (Exception $e) {
        header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_listaprecio.php?msj=6 ");
    }
}