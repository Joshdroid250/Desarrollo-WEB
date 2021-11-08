<?php
include_once("conexion.php");
class dt_parroquia extends Conexion
{
    private $myCon;
    public function listaParroquia()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_parroquia;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cg = new parroquia();

                $cg->__SET('idParroquia', $r->idParroquia);
                $cg->__SET('nombre', $r->nombre);
                $cg->__SET('direccion', $r->direccion);
                $cg->__SET('parroco', $r->parroco);
                $cg->__SET('logo', $r->logo);
                $cg->__SET('sitio_web', $r->sitio_web);
                
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

    public function ObtenerListaParroquia($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_parroquia WHERE idParroquia = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cg = new kermesse();
            
            $cg->__SET('idParroquia', $r->idParroquia);
            $cg->__SET('nombre', $r->nombre);
            $cg->__SET('direccion', $r->direccion);
            $cg->__SET('parroco', $r->parroco);
            $cg->__SET('logo', $r->logo);
            $cg->__SET('sitio_web', $r->sitio_web);

            $this->myCon = parent::desconectar();
            return $cg;


        }

        catch (Exception $cg)
        {
            die($cg->getMessage());
        }
    }
}