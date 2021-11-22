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
                $kr = new kermesse();

                $kr->__SET('id_kermesse', $r->id_kermesse);
                $kr->__SET('idParroquia', $r->idParroquia);
                $kr->__SET('nombre', $r->nombre);
                $kr->__SET('fInicio', $r->fInicio);
                $kr->__SET('fFinal', $r->fFinal);
                $kr->__SET('descripcion', $r->descripcion);
                $kr->__SET('estado', $r->estado);
                $kr->__SET('usuario_creacion', $r->usuario_creacion);
                $kr->__SET('fecha_creacion', $r->fecha_creacion);
                $kr->__SET('usuario_modificacion', $r->usuario_modificacion);
                $kr->__SET('fecha_modificacion', $r->fecha_modificacion);
                $kr->__SET('usuario_eliminacion', $r->usuario_eliminacion);
                $kr->__SET('fecha_eliminacion', $r->fecha_eliminacion);
                
                $result[] = $kr;
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
            $querySQL = "SELECT * FROM dbkermesse.vw_kermesse_parroquia WHERE id_kermesse = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $kr = new kermesse();
            
            $kr->__SET('id_kermesse', $r->id_kermesse);
            $kr->__SET('idParroquia', $r->idParroquia);
            $kr->__SET('nombreParro', $r->nombreParro);
            $kr->__SET('nombreKerme', $r->nombreKerme);
            $kr->__SET('fInicio', $r->fInicio);
            $kr->__SET('fFinal', $r->fFinal);
            $kr->__SET('descripcion', $r->descripcion);
            $kr->__SET('estado', $r->estado);
            $kr->__SET('usuario_creacion', $r->usuario_creacion);
            $kr->__SET('fecha_creacion', $r->fecha_creacion);
            $kr->__SET('usuario_modificacion', $r->usuario_modificacion);
            $kr->__SET('fecha_modificacion', $r->fecha_modificacion);
            $kr->__SET('usuario_eliminacion', $r->usuario_eliminacion);
            $kr->__SET('fecha_eliminacion', $r->fecha_eliminacion);

            $this->myCon = parent::desconectar();
            return $kr;


        }

        catch (Exception $cg)
        {
            die($cg->getMessage());
        }
    }
}