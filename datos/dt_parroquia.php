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
                $pr = new parroquia();

                $pr->__SET('idParroquia', $r->idParroquia);
                $pr->__SET('nombre', $r->nombre);
                $pr->__SET('direccion', $r->direccion);
                $pr->__SET('parroco', $r->parroco);
                $pr->__SET('logo', $r->logo);
                $pr->__SET('sitio_web', $r->sitio_web);
                
                $result[] = $pr;
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
            $pr = new kermesse();
            
            $pr->__SET('idParroquia', $r->idParroquia);
            $pr->__SET('nombre', $r->nombre);
            $pr->__SET('direccion', $r->direccion);
            $pr->__SET('parroco', $r->parroco);
            $pr->__SET('logo', $r->logo);
            $pr->__SET('sitio_web', $r->sitio_web);

            $this->myCon = parent::desconectar();
            return $pr;


        }

        catch (Exception $pr)
        {
            die($pr->getMessage());
        }
    }
}