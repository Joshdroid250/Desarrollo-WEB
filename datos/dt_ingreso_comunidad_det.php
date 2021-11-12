<?php

use comunidad as GlobalComunidad;

include_once("conexion.php");

class ingreso_comunidad_det extends Conexion{

  private $myCon;


    public function ingreso_comunidad_det()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_ingreso_comunidad_det;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cp = new ingreso_comunidad_det();

                $cp->__SET('id_ingreso_comunidad_det', $r->id_ingreso_comunidad_det);
                $cp->__SET('id_ingreso_comunidad', $r->id_ingreso_comunidad);
                $cp->__SET('id_bono', $r->id_bono);
                $cp->__SET('denominacion', $r->denominacion);
                $cp->__SET('cantidad', $r->cantidad);
                $cp->__SET('subtotal_bono', $r->subtotal_bono);
               
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

    public function ingreso_comunidad_deta($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_ingreso_comunidad_det WHERE id_ingreso_comunidad_det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cp = new ingreso_comunidad_det();

            
            $cp->__SET('id_ingreso_comunidad_det', $r->id_ingreso_comunidad_det);
                $cp->__SET('id_ingreso_comunidad', $r->id_ingreso_comunidad);
                $cp->__SET('id_bono', $r->id_bono);
                $cp->__SET('denominacion', $r->denominacion);
                $cp->__SET('cantidad', $r->cantidad);
                $cp->__SET('subtotal_bono', $r->subtotal_bono);

            $this->myCon = parent::desconectar();
            return $cp;


        }

        catch (Exception $cp)
        {
            die($cp->getMessage());
        }
    }
}