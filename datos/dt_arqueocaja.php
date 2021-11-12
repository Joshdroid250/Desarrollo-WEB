<?php

include_once("conexion.php");

class Dt_arqueocaja extends Conexion{

  private $myCon;

    public function lista_arqueocaja()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_arqueocaja;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new arqueoCaja();

                $gt->__SET('id_ArqueoCaja', $r->id_arqueo_caja);
                $gt->__SET('idKermesse', $r->idKermesse);
                $gt->__SET('fechaArqueo', $r->fecha_arqueo);
                $gt->__SET('granTotal', $r->granTotal);
                $gt->__SET('usuario_creacion', $r->usuario_creacion);
                $gt->__SET('fecha_creacion', $r->fecha_creacion);
                $gt->__SET('usuario_modificacion', $r->usuario_modificacion);
                $gt->__SET('fecha_modificacion', $r->fecha_modificacion);
                $gt->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $gt->__SET('fecha_eliminacion', $r->fecha_eliminacion);
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
    public function obtenerarqueo_caja($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_arqueocaja WHERE id_ArqueoCaja = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new arqueoCaja();

                $gt->__SET('id_ArqueoCaja', $r->id_arqueo_caja);
                $gt->__SET('idKermesse', $r->idKermesse);
                $gt->__SET('fechaArqueo', $r->fecha_arqueo);
                $gt->__SET('granTotal', $r->granTotal);
                $gt->__SET('usuario_creacion', $r->usuario_creacion);
                $gt->__SET('fecha_creacion', $r->fecha_creacion);
                $gt->__SET('usuario_modificacion', $r->usuario_modificacion);
                $gt->__SET('fecha_modificacion', $r->fecha_modificacion);
                $gt->__SET('usuario_eliminacion', $r->usuario_eliminaciono);
                $gt->__SET('fecha_eliminacion', $r->fecha_eliminacion);
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