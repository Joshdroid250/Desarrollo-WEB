<?php

include_once("conexion.php");

class Dt_tasacambio_det extends Conexion{

  private $myCon;

    public function listatasacambio_det()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tasacambio_det;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new tasacambiodet();

                $gt->__SET('id_tasaCambio_det', $r->id_tasacambio_det);
                $gt->__SET('id_tasaCambio', $r->id_tasacambio);
                $gt->__SET('fecha', $r->fecha);
                $gt->__SET('tipoCambio', $r->tipoCambio);
                $gt->__SET('estado', $r->estado);
                                
                $result[] = $gt;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    public function obtener_tasacambio_det($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tasacambio_det WHERE id_tasaCambio_det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new Gastos();

                $gt->__SET('id_tasaCambio_det', $r->id_tasacambio_det);
                $gt->__SET('id_tasaCambio', $r->id_tasacambio);
                $gt->__SET('fecha', $r->fecha);
                $gt->__SET('tipoCambio', $r->tipoCambio);
                $gt->__SET('estado', $r->estado);
                
            $this->myCon = parent::desconectar();
            return $gt;


        }

        catch (Exception $gt)
        {
            die($gt->getMessage());
        }
    }
}