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
            $querySQL = "SELECT * FROM dbkermesse.tbl_categoria_producto;";

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
}