<?php

include_once("conexion.php");

class Dt_tasacambio extends Conexion{

  private $myCon;

    public function listatasacambio()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_tasacambio;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new tasacambio();

                $gt->__SET('id_tasaCambio', $r->id_tasacambio);
                $gt->__SET('id_monedaO', $r->idmonedaO);
                $gt->__SET('id_monedaC', $r->idmonedaC);
                $gt->__SET('mes', $r->mes);
                $gt->__SET('anio', $r->anio);
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
    public function obtenertasacambio($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_tasacambio WHERE id_tasaCambio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new tasacambio();

                $gt->__SET('id_tasaCambio', $r->id_tasacambio);
                $gt->__SET('idmonedaO', $r->idmonedaO);
                $gt->__SET('idmonedaC', $r->idmonedaC);
                $gt->__SET('mes', $r->mes);
                $gt->__SET('anio', $r->anio);
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