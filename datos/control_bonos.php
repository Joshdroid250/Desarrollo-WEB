<?php

use comunidad as GlobalComunidad;

include_once("conexion.php");

class control_bonos extends Conexion{

  private $myCon;


    public function control_bonos()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_control_bono;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cp = new control_bonos();

                $cp->__SET('id_bono', $r->id_bono);
                $cp->__SET('nombre', $r->nombre);
                $cp->__SET('valor', $r->valor);
                $cp->__SET('estado', $r->estadp);
               
                
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

    public function control_bono($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_control_bono WHERE id_bono = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cp = new control_bonos();

            
            $cp->__SET('id_bono', $r->id_bono);
                $cp->__SET('nombre', $r->nombre);
                $cp->__SET('valor', $r->valor);
                $cp->__SET('estado', $r->estadp);

            $this->myCon = parent::desconectar();
            return $cp;


        }

        catch (Exception $cp)
        {
            die($cp->getMessage());
        }
    }
}