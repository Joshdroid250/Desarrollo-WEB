<?php

include_once("conexion.php");

class Dt_categoria_gastos extends Conexion{

  private $myCon;


    public function listacgastos()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_categoria_gastos;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cg = new Categoriag();

                $cg->__SET('id_categoria_gastos', $r->id_categoria_gastos);
                $cg->__SET('nombre_categoria', $r->nombre_categoria);
                $cg->__SET('descripcion', $r->descripcion);
                $cg->__SET('estado', $r->estado);
                
                $result[] = $cg;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerCategoriaG($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_categoria_gastos WHERE id_categoria_gastos = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cg = new Categoriag();

            $cg->__SET('id_categoria_gastos', $r->id_categoria_gastos);
            $cg->__SET('nombre_categoria', $r->nombre_categoria);
            $cg->__SET('descripcion', $r->descripcion);
            $cg->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $cg;


        }

        catch (Exception $cg)
        {
            die($cg->getMessage());
        }
    }
}
