<?php

include_once("../entidades/usuario.php");
include_once("../datos/dt_Usuario.php");

$u = new Usuario();
$dtu = new Dt_Usuario();

if ($_POST) 
{
    $varAccion = $_POST['txtaccion'];

    switch ($varAccion) 
    {
        case '1':
            try 
            {
                //CONSTRUIMOS EL OBJETO
                //ATRIBUTO ENTIDAD //NAME DEL CONTROL
                $u->__SET('usuario', $_POST['user_name']);
                $u->__SET('pwd', $_POST['user_pwd']);
                $u->__SET('nombres', $_POST['user_nombres']);
                $u->__SET('apellidos', $_POST['user_apellidos']);
                $u->__SET('email', $_POST['user_email']);

                $dtu->insertUser($u);
                //var_dump($emp);
                header("Location: /Desarrollo-WEB-master/pages/catalogos/tbl_usuarios.php?msj=1");
            } 
            catch (Exception $e) 
            {
                header("Location:  /Desarrollo-WEB-master/pages/catalogos/tbl_usuarios.php?msj=2");
                die($e->getMessage());
            }
            break;
        
        case '2':
            # code...
            break;
        
        case '3':
            //obtenemos los valores ingresados por el usuario 
            $usuario=$_POST["user"];
            $password=$_POST["pwd"];
            
            if(empty($usuario) and empty($password)){
                //nos envía al inicio
                header("Location: ../login.php?msj=403");
            }
            else{
                $u = $dtu->validarUser($usuario, $password);
                if(empty($u)){
                    header("Location: ../login.php?msj=401");
                }
                else{
                    //Iniciamos la sesion
                    session_start();
                    //Asignamos la sesion
                    $_SESSION['acceso']=$u;
                    //Si la variable de sesión está correctamente definida
                    if (!isset($_SESSION['acceso'])) { 
                        //nos envía al inicio
                        header("Location: ../login.php?msj=400");      
                    }
                    else{
                        //nos envía al inicio
                        //var_dump($_SESSION['acceso']);
                        header("Location: ../sistema-kermesse.php?msj=1"); 
                    }
        
                }
            }
            break;
        
        default:
            # code...
            break;
    }
}

if ($_GET) 
{
    try 
    {
        
        $u->__SET('id_usuario', $_GET['delU']);
        $dtu->deleteUser($u->__GET('id_usuario'));
        header("Location:  /Desarrollo-WEB-master/pages/catalogos/tbl_usuarios.php?msj=5");
    }
    catch(Exception $e)
    {
        header("Location:  /Desarrollo-WEB-master/pages/catalogos/tbl_usuarios.php?msj=6");
        die($e->getMessage());
    }
}