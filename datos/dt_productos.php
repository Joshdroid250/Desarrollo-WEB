<?php

include_once("conexion.php");

class Dt_productos extends Conexion{

  private $myCon;


    public function listaproductos()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_productos;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $prod = new Productos();

                $prod->__SET('id_producto', $r->id_producto);
                $prod->__SET('id_comunidad', $r->id_comunidad);
                $prod->__SET('id_cat_producto', $r->id_cat_producto);
                $prod->__SET('nombre', $r->nombre);
                $prod->__SET('descripcion', $r->descripcion);
                $prod->__SET('cantidad', $r->cantidad);
                $prod->__SET('preciov_sugerido', $r->preciov_sugerido);
                $prod->__SET('estado', $r->estado);
                
                $result[] = $prod;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerProducto($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_productos WHERE id_producto = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $prod = new Productos();

            $prod->__SET('id_producto', $r->id_producto);
                $prod->__SET('id_comunidad', $r->id_comunidad);
                $prod->__SET('id_cat_producto', $r->id_cat_producto);
                $prod->__SET('nombre', $r->nombre);
                $prod->__SET('descripcion', $r->descripcion);
                $prod->__SET('cantidad', $r->cantidad);
                $prod->__SET('preciov_sugerido', $r->preciov_sugerido);
                $prod->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $prod;


        }

        catch (Exception $prod)
        {
            die($prod->getMessage());
        }
    }
}