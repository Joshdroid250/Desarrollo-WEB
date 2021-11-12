<?php

use comunidad as GlobalComunidad;

include_once("conexion.php");

class comunidad extends Conexion{

  private $myCon;


    public function ingreso_comunidad()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_ingreso_comunidad;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cp = new ingreso_comunidad();

                $cp->__SET('id_ingreso_comunidad', $r->id_comunidad);
                $cp->__SET('id_kermesse', $r->id_kermesse);
                $cp->__SET('id_comunidad', $r->id_comunidad);
                $cp->__SET('cant_productos', $r->cant_producto);
                $cp->__SET('total_bonos', $r->total_bonos);
                $cp->__SET('usuario_creacion', $r->usuario_creacion);
                $cp->__SET('fecha_cracion', $r->fecha_creacion);
                $cp->__SET('usuario_modificacion', $r->usuario_modificacion);
                $cp->__SET('fecha_modificacion', $r->fecha_modificacion);
                $cp->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $cp->__SET('fecha_eliminacion', $r->fecha_eliminacion);
                
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
            $querySQL = "SELECT * FROM dbkermesse.tbl_ingreso_comunidad WHERE id_ingreso_comunidad = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cp = new ingreso_comunidad();

            
            $cp->__SET('id_ingreso_comunidad', $r->id_comunidad);
                $cp->__SET('id_kermesse', $r->id_kermesse);
                $cp->__SET('id_comunidad', $r->id_comunidad);
                $cp->__SET('cant_productos', $r->cant_producto);
                $cp->__SET('total_bonos', $r->total_bonos);
                $cp->__SET('usuario_creacion', $r->usuario_creacion);
                $cp->__SET('fecha_cracion', $r->fecha_creacion);
                $cp->__SET('usuario_modificacion', $r->usuario_modificacion);
                $cp->__SET('fecha_modificacion', $r->fecha_modificacion);
                $cp->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $cp->__SET('fecha_eliminacion', $r->fecha_eliminacion);

            $this->myCon = parent::desconectar();
            return $cp;


        }

        catch (Exception $cp)
        {
            die($cp->getMessage());
        }
    }
}