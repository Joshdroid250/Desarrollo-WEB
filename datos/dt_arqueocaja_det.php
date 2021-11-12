<?php

include_once("conexion.php");

class Dt_arqueocaja_det extends Conexion{

  private $myCon;

    public function lista_arqueocaja_det()
    {
        try 
        {
            $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_arqueocaja_det;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new arqueoCaja_det();

                $gt->__SET('idArqueoCaja_Det', $r->idArqueoCaja_det);
                $gt->__SET('idArqueoCaja', $r->id_arqueo_caja);
                $gt->__SET('idMoneda', $r->idMoneda);
                $gt->__SET('idDenominacion', $r->idDenominacion);
                $gt->__SET('cantidad', $r->cantidad);
                $gt->__SET('subtotal', $r->subtotal);
                
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
    public function obtener_arqueocaja_det($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_arqueocaja_det WHERE idArqueoCaja_Det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new arqueoCaja_det();

                $gt->__SET('idArqueoCaja_Det', $r->idArqueoCaja_det);
                $gt->__SET('idArqueoCaja', $r->id_arqueo_caja);
                $gt->__SET('idMoneda', $r->idMoneda);
                $gt->__SET('idDenominacion', $r->idDenominacion);
                $gt->__SET('cantidad', $r->cantidad);
                $gt->__SET('subtotal', $r->subtotal);

            $this->myCon = parent::desconectar();
            return $gt;


        }

        catch (Exception $gt)
        {
            die($gt->getMessage());
        }
    }
}