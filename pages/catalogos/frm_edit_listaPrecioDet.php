<?php

error_reporting(0);
include '../../datos/dt_lista_preciodet.php';
include '../../entidades/listaprecio_det.php';
include '../../datos/dt_listaPrecio.php';
include '../../entidades/lista_precio.php';
include '../../datos/dt_productos.php';
include '../../entidades/productos.php';
//IMPORTAMOS ENTIDADES
include '../../entidades/usuario.php';
include '../../entidades/rol.php';
include '../../entidades/opciones.php';
//IMPORTAMOS DATOS
include '../../datos/dt_Rol.php';
include '../../datos/dt_opciones.php';

//ENTIDADES
$usuario = new Usuario();
$rol = new Rol();
$listOpc = new Opciones();
//DATOS
$dtr = new Dt_Rol();
$dtOpc = new Dt_Opciones();

$dtLista = new Dt_ListaPrecio();
$dtProd = new Dt_Productos();
$dtlist = new dt_lista_preciodet();
$list = new ListaPrecioDet();
$varIdLista = 0;
if (isset($varIdLista)) {
  $varIdLista = $_GET['editLD'];
}

$lista = $dtlist->ObtenerlistaprecioDet($varIdLista);

//MANEJO Y CONTROL DE LA SESION
session_start(); // INICIAMOS LA SESION

//VALIDAMOS SI LA SESION ESTÁ VACÍA
if (empty($_SESSION['acceso'])) { 
    //nos envía al inicio
    header("Location: login.php?msj=2");
}

$usuario = $_SESSION['acceso']; // OBTENEMOS EL VALOR DE LA SESION

//OBTENEMOS EL ROL
$rol->__SET('id_rol', $dtr->getIdRol($usuario[0]->__GET('usuario')));

//OBTENEMOS LAS OPCIONES DEL ROL
$listOpc = $dtOpc->getOpciones($rol->__GET('id_rol'));

//OBTENEMOS LA OPCION ACTUAL
$url = $_SERVER['REQUEST_URI'];
// var_dump($url);
$inicio= strrpos($url, '/')+1; 
// var_dump($inicio); //6
// $total= strlen($url); 
// var_dump($total); //28
$fin= strripos($url, '?');
// var_dump($fin); //22
if($fin>0){
    $miPagina = substr($url, $inicio, $fin-$inicio);
    // var_dump($miPagina);
}
else{
    $miPagina = substr($url, $inicio);
    // var_dump($miPagina);
}

////// VALIDAMOS LA OPCIÓN ACTUAL CON LA MATRIZ DE OPCIONES //////
//obtenemos el numero de elementos
$longitud = count($listOpc);
$acceso = false; // VARIABLE DE CONTROL

//Recorro todos los elementos de la matriz de opciones
for($i=0; $i<$longitud; $i++)
    {
      //obtengo el valor de cada elemento
      $opcion = $listOpc[$i]->__GET('opcion_descripcion');
      if (strcmp ($miPagina , $opcion) == 0) //COMPARO LA OPCION ACTUAL CON CADA OPCIÓN DE LA MATRIZ
      {
        $acceso = true; //ACCESO CONCEDIDO
        break;
      }
    }

if(!$acceso)
{
    //ACCESO NO CONCEDIDO 
    header("Location: ../../401.php"); //REDIRECCIONAMOS A LA PAGINA DE ACCESO RESTRINGIDO
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../../login.php" title="Cerrar Sesion">
            <i class="fas fa-power-off"></i> Cerrar Sesion
          </a>
        </li>
      </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../sistema-kermesse.php" class="brand-link">
      <img src="../../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema Kermesse</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Control
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class=""></i>
                  <p>
                    Productos
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/catalogos/tbl_productos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="pages/catalogos/tbl_categoria_productos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class=""></i>
                  <p>
                    Gastos
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tbl_gastos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gastos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tbl_categoria_gastos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class=""></i>
                  <p>
                    Kermesse
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="tbl_parroquia.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parroquia</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="tbl_kermesse.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kermesse</p>
                  </a>
                </li>
                </a>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class=""></i>
                <p>
                  Lista precio
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tbl_listaPrecio.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de precio</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
                <i class=""></i>
                <p>
                  Seguridad
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tbl_opciones.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabla Opciones</p>
                </a>
              </li>
            </ul>
          </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista precio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Lista precio detalle</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Lista precio Detalle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="../../negocio/ng_listaPrecioDet.php">
              <div class="card-body">
              <div class="form-group">
                      <input type="hidden" value="2" name="txtaccion" id="txtaccion" />
                      <label>ID</label>
                      <input readonly value="<?php echo $lista->__GET('id_listaprecio_det')?>" type="number" class="form-control" id="id_listaprecio_det" name="id_listaprecio_det" placeholder="" required>
                      <input type="hidden" value="2" name="txtaccion" id="txtaccion"/>
                    </div>
              <div class="form-group">
                      <label>Seleccione una lista precio</label>
                      <select id="id_lista_precio" name="id_lista_precio" class="form-control">
                        <option value="">Seleccione...</option>


                        <?php

                        foreach ($dtLista->listaPrecio() as $r) :
                        ?>
                          <tr>
                            <option value="<?php echo $r->__GET('id_lista_precio'); ?>"><?php echo $r->__GET('nombre'); ?></option>
                          </tr>
                        <?php
                        endforeach;

                        ?>


                      </select>

                    </div>
                    <div class="form-group">
                    <label>Precio de venta</label>
                    <input value="<?php echo $lista->__GET('precio_venta') ?>" type="number" class="form-control" id="precio_venta" name="precio_venta" placeholder="">
                  </div>
                    <div class="form-group">
                      <label>Seleccione un producto</label>
                      <select id="id_producto" name="id_producto" class="form-control">
                        <option value="">Seleccione...</option>


                        <?php

                        foreach ($dtProd->listaproductos() as $r) :
                        ?>
                          <tr>
                            <option value="<?php echo $r->__GET('id_producto'); ?>"><?php echo $r->__GET('nombre'); ?></option>
                          </tr>
                        <?php
                        endforeach;

                        ?>


                      </select>

                      </div>
              </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
function setParroquia(){

$("#nombre_categoria").val("<?php echo $cat-> __GET('nombre_categoria')?>");
$("#descripcion").val("<?php echo $cat-> __GET('descripcion')?>");
$("#estado").val("<?php echo $cat-> __GET('estado')?>");

}

$(document).ready(function()
{
  setParroquia();
});

</script>
</body>
</html>
