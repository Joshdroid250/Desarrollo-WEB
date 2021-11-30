<?php
error_reporting(0);


//IMPORTAMOS ENTIDADES
include '../../entidades/usuario.php';
include '../../entidades/rol.php';
include '../../entidades/opciones.php';
//IMPORTAMOS DATOS
include '../../datos/dt_Rol.php';
include '../../datos/dt_opciones.php';
$dtOpc = new Dt_opciones();
//ENTIDADES
$usuario = new Usuario();
$rol = new Rol();
$listOpc = new Opciones();
//DATOS
$dtr = new Dt_Rol();
$dtOpc = new Dt_Opciones();


$varMsj = 0;
if(isset($varMsj))
{
    $varMsj = $_GET['msj'];
}

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
  <title>dbkermesse | opciones</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/DataTables1.11.2-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/DataTables1.11.2-/Responsive-2.2.9/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/DataTables1.11.2/Buttons-2.0.0/css/buttons.bootstrap4.min.css">
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
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Datos Parroquia</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

            </section>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Opciones</h3>
                </div>
                <div class="card-body">
                    <div class="form-group col-md-12" style="text-align:right">
                    <a href="frm_opciones.php" title="Nueva Opcion" target="blank"><i class="far fa-plus-square"></i></a>
                    </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>ID</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                   
                  </tr>

                  </thead>

                  <tbody>
                    <?php
                      foreach($dtOpc->listOpciones() as $r):
                        $estadoOpc = "";
                        if ($r->__GET('estado') == 1 || $r->__GET('estado') == 2){
                            $estadoOpc = "Activo";
                        }
                        else{
                            $estadoOpc = "Inactivo";
                        }
                    ?>
                    <tr>
                      <td><?php echo $r->__GET('id_opciones'); ?></td>
                      <td><?php echo $r->__GET('opcion_descripcion'); ?></td>
                      <td><?php echo $estadoOpc; ?></td>
                      <td> <a href="frm_edit_opciones.php?EditO=<?php echo $r->__GET('id_opciones');?>" target="blank">
                    <i class="far fa-edit" title="Editar Opcion"></i></a>
                    &nbsp;&nbsp;
                    <a href="frm_view_opciones.php?viewO=<?php echo $r->__GET('id_opciones');?>" target="blank">
                    <i class="far fa-eye" title="Ver parroquia"></i></a>
                    &nbsp;&nbsp;
                    <a href="../../negocio/ng_opciones.php?delO=<?php echo $r->__GET('id_opciones');?>"target="blank">
                      <i class="far fa-trash-alt" title="Eliminar"></i>
                    </a>
                    </td>
                    </tr>
                    <?php
                      endforeach;
                    ?>
                  </tbody>

                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                   
                  </tr>
                  </tfoot>
                    </table>
                </div>
                </div>
        </div>
    </div>
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
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

       <!-- AdminLTE App -->
    <script src="../../plugins/jAlert/dist/jAlert.min.js"></script>
    <script src="../../plugins/jAlert/dist/jAlert-functions.min.js"> //optional!! </script>


    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        function deleteOpc(idO)
        {
            confirm(function(e,btn)
            {
                e.preventDefault();
                window.location.href = "../../negocio/ng_opciones.php?delO="+idO;
            },
            function(e,btn)
            {
                e.preventDefault();      
            });
        }
        $(document).ready(function()
        {
            var mensaje = 0;
                        mensaje = "<?php echo $varMsj?>";
                        if(mensaje == "1")
                        {
                            successAlert('Exito', 'Los datos han sido registrados exitosamente');
                        }
                        if(mensaje == "2"|| mensaje =="4" || mensaje =="6")
                        {
                            errorAlert('Error', 'Revise los datos e intente de nuevo');
                        }
                        if(mensaje == "3")
                        {
                            successAlert('Exito', 'Los datos han sido actualizados exitosamente');
                        }
                        if(mensaje == "5")
                        {
                            successAlert('Exito', 'Los datos han sido eliminados exitosamente');
                        }
                        

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    }); // FIN DOC READY FUN
    </script>

</body>

</html>