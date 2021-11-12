<?php

include_once("conexion.php");

class Dt_moneda extends Conexion{

  private $myCon;

    public function listamoneda()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_moneda;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new Moneda();

                $gt->__SET('id_moneda', $r->idMoneda);
                $gt->__SET('nombre', $r->nombre);
                $gt->__SET('simbolo', $r->simbolo);
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
    public function obtenermoneda($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_moneda WHERE id_moneda = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new Moneda();

                $gt->__SET('id_moneda', $r->idMoneda);
                $gt->__SET('nombre', $r->nombre);
                $gt->__SET('simbolo', $r->simbolo);
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