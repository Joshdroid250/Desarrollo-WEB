<?php

include_once("conexion.php");

class Dt_rol extends Conexion{

  private $myCon;


    public function listarol()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_rol;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $tc = new Rol();

                $tc->__SET('id_rol', $r->id_rol);
                $tc->__SET('rol_descripcion', $r->rol_descripcion);
                $tc->__SET('estado', $r->estado);
               
                
                $result[] = $tc;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerRol($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_rol WHERE id_rol = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $tc = new Rol();

            $tc->__SET('id_rol', $r->id_rol);
            $tc->__SET('rol_descripcion', $r->rol_descripcion);
            $tc->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $tc;


        }

        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function borrarRol($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "DELETE FROM dbkermesse.tbl_rol WHERE id_rol = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
            catch (Exception $e)
            {
                die($e->getMessage());
            }
    }
    public function editRol(Rol $cp)

    {
        try{
            $this->myCon = parent::conectar();
            $sql = "UPDATE dbkermesse.tbl_rol SET
            rol_descripcion = ?,
            estado = ?
            WHERE id_rol = ?;";

        $this->myCon->prepare($sql)
        ->execute(
            array(
                $cp->__GET('id_rol'),
                $cp->__GET('rol_descripcion'),
                $cp->__GET('estado')
                
         
            )
            );
            $this->myCon = parent::desconectar();
        }
        catch (Exception $e)
        {
            var_dump($e);
            die($e->getMessage());
        }
    }

    public function registrarRol(Rol $cp)
    {
        try
        {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_rol (id_rol, rol_descripcion, estado) values (?,?,?)";
            $this->myCon->prepare($sql)
            ->execute(array(
                $cp->__GET('id_rol'),
                $cp->__GET('rol_descripcion'),
                $cp->__GET('estado')
            ));
            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
                die($e->getMessage());
        }
    }
}