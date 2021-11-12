<?php

use comunidad as GlobalComunidad;

include_once("conexion.php");

class comunidad extends Conexion{

  private $myCon;


    public function comunidad()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_comunidad;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cp = new comunidad();

                $cp->__SET('id_comunidad', $r->id_comunidad);
                $cp->__SET('nombre', $r->nombre);
                $cp->__SET('responsable', $r->responsable);
                $cp->__SET('estado', $r->estado);
                
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

    public function ObtenerComunidad($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_comunidad WHERE id_comunidad = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cp = new comunidad();

            
            $cp->__SET('id_comunidad', $r->id_comunidad);
            $cp->__SET('nombre', $r->nombre);
            $cp->__SET('responsable', $r->responsable);
            $cp->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $cp;


        }

        catch (Exception $cp)
        {
            die($cp->getMessage());
        }
    }
}