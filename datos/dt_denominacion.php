<?php

include_once("conexion.php");

class Dt_denominacion extends Conexion{

  private $myCon;

    public function listadenominacion()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_denominacion;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new denominacion();

                $gt->__SET('id_Denominacion', $r->idDenominacion);
                $gt->__SET('idMoneda', $r->idmoneda);
                $gt->__SET('valor', $r->valor);
                $gt->__SET('valor_letras', $r->valor_letras);
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
    public function obtenerdenominacion($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_denominacion WHERE id_Denominacion = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new denominacion();

                $gt->__SET('id_Denominacion', $r->id_Denominacion);
                $gt->__SET('idMoneda', $r->idMoneda);
                $gt->__SET('valor', $r->valor);
                $gt->__SET('valor_letras', $r->valor_letras);
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