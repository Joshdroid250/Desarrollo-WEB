<?php

include_once("conexion.php");

class Dt_gastos extends Conexion{

  private $myCon;

    public function listagastos()
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
                $gt = new Gastos();

                $gt->__SET('id_registro_gastos', $r->id_registro_gastos);
                $gt->__SET('idKermesse', $r->idKermesse);
                $gt->__SET('idCatGastos', $r->idCatGastos);
                $gt->__SET('fechaGasto', $r->fechaGasto);
                $gt->__SET('concepto', $r->concepto);
                $gt->__SET('monto', $r->monto);
                $gt->__SET('usuario_creacion', $r->usuario_creacion);
                $gt->__SET('fecha_creacion', $r->fecha_creacion);
                $gt->__SET('usuario_modificacion', $r->usuario_modificacion);
                $gt->__SET('fecha_modificacion', $r->fecha_modificacion);
                $gt->__SET('usuario_eliminacion', $r->estadusuario_eliminaciono);
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
    public function obtenergasto($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_gastos WHERE id_registro_gastos = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new Gastos();

                $gt->__SET('id_registro_gastos', $r->id_registro_gastos);
                $gt->__SET('idKermesse', $r->idKermesse);
                $gt->__SET('idCatGastos', $r->idCatGastos);
                $gt->__SET('fechaGasto', $r->fechaGasto);
                $gt->__SET('concepto', $r->concepto);
                $gt->__SET('monto', $r->monto);
                $gt->__SET('usuario_creacion', $r->usuario_creacion);
                $gt->__SET('fecha_creacion', $r->fecha_creacion);
                $gt->__SET('usuario_modificacion', $r->usuario_modificacion);
                $gt->__SET('fecha_modificacion', $r->fecha_modificacion);
                $gt->__SET('usuario_eliminacion', $r->estadusuario_eliminaciono);
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