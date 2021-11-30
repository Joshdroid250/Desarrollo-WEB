<?php

include_once("conexion.php");

class Dt_categoria_productos extends Conexion{

  private $myCon;


    public function listacproductos()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_categoria_producto WHERE estado<>3;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cp = new CategoriaP();

                $cp->__SET('id_categoria_producto', $r->id_categoria_producto);
                $cp->__SET('nombre', $r->nombre);
                $cp->__SET('descripcion', $r->descripcion);
                $cp->__SET('estado', $r->estado);
                
                $result[] = $cp;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerCategoriaP($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_categoria_producto WHERE id_categoria_producto = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cp = new Categoriap();

            $cp->__SET('id_categoria_producto', $r->id_categoria_producto);
                $cp->__SET('nombre', $r->nombre);
                $cp->__SET('descripcion', $r->descripcion);
                $cp->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $cp;


        }

        catch (Exception $cp)
        {
            die($cp->getMessage());
        }
    }

    public function editCategoriap(CategoriaP $cp)

    {
        try{
            $this->myCon = parent::conectar();
            $sql = "UPDATE dbkermesse.tbl_categoria_producto SET
            nombre = ?,
            descripcion = ?,
            estado = ?
            WHERE id_categoria_producto = ?;";

        $this->myCon->prepare($sql)
        ->execute(
            array(
               
                $cp->__GET('nombre'),
                $cp->__GET('descripcion'),
                $cp->__GET('estado'),
                $cp->__GET('id_categoria_producto')

         
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

    public function registrarCategoriaP(CategoriaP $cp)
    {
        try
        {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_categoria_producto (id_categoria_producto, nombre, descripcion, estado) values (?,?,?,?)";
            $this->myCon->prepare($sql)
            ->execute(array(
                $cp->__GET('id_categoria_producto'),
                $cp->__GET('nombre'),
                $cp->__GET('descripcion'),
                $cp->__GET('estado')
            ));
            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
                die($e->getMessage());
        }
    }

    public function borrarCategoriaP($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "UPDATE dbkermesse.tbl_categoria_producto SET estado=3 WHERE id_categoria_producto = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
            catch (Exception $e)
            {
                die($e->getMessage());
            }
    }


}