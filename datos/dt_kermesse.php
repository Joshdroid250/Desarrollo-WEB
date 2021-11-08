<?php
include_once("conexion.php");
class dt_kermesse extends Conexion
{
    private $myCon;
    public function listaKermesse()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_kermesse;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cg = new kermesse();

                $cg->__SET('id_kermesse', $r->id_kermesse);
                $cg->__SET('idParroquia', $r->idParroquia);
                $cg->__SET('nombre', $r->nombre);
                $cg->__SET('fInicio', $r->fInicio);
                $cg->__SET('fFinal', $r->fFinal);
                $cg->__SET('descripcion', $r->descripcion);
                $cg->__SET('estado', $r->estado);
                $cg->__SET('usuario_creacion', $r->usuario_creacion);
                $cg->__SET('fecha_creacion', $r->fecha_creacion);
                $cg->__SET('usuario_modificacion', $r->usuario_modificacion);
                $cg->__SET('fecha_modificacion', $r->fecha_modificacion);
                $cg->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $cg->__SET('fecha_eliminacion', $r->fecha_eliminacion);
                
                $result[] = $cg;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerListaKermesse($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_kermesse WHERE id_kermesse = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cg = new kermesse();
            
            $cg->__SET('id_kermesse', $r->id_kermesse);
            $cg->__SET('idParroquia', $r->idParroquia);
            $cg->__SET('nombre', $r->nombre);
            $cg->__SET('fInicio', $r->fInicio);
            $cg->__SET('fFinal', $r->fFinal);
            $cg->__SET('descripcion', $r->descripcion);
            $cg->__SET('estado', $r->estado);
            $cg->__SET('usuario_creacion', $r->usuario_creacion);
            $cg->__SET('fecha_creacion', $r->fecha_creacion);
            $cg->__SET('usuario_modificacion', $r->usuario_modificacion);
            $cg->__SET('fecha_modificacion', $r->fecha_modificacion);
            $cg->__SET('usuario_eliminacion', $r->usuario_eliminacion);
            $cg->__SET('fecha_eliminacion', $r->fecha_eliminacion);

            $this->myCon = parent::desconectar();
            return $cg;


        }

        catch (Exception $cg)
        {
            die($cg->getMessage());
        }
    }
}