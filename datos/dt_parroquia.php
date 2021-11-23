<?php
include_once("conexion.php");
class Dt_parroquia extends Conexion
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
                $pr->__SET('telefono', $r->telefono);
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


    public function editParroquia(Parroquia $pr)
    {
        try{
            $this->myCon = parent::conectar();
            $sql = "UPDATE tbl_parroquia SET
            nombre = ?,
            direccion = ?, 
            telefono = ?, 
            parroco = ?, 
            logo = ?, 
            sitio_web = ? WHERE idParroquia = ?";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $pr->__GET('nombre'),
                    $pr->__GET('direccion'),
                    $pr->__GET('telefono'),
                    $pr->__GET('parroco'),
                    $pr->__GET('logo'),
                    $pr->__GET('sitio_web'),
                    $pr->__GET('idParroquia')
                ));
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function regParroquia(parroquia $pr)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_parroquia (idParroquia,nombre,direccion,telefono,parroco,logo,sitio_web)
            VALUES (?,?,?,?,?,?,?)";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $pr->__GET('idParroquia'),
                    $pr->__GET('nombre'),
                    $pr->__GET('direccion'),
                    $pr->__GET('telefono'),
                    $pr->__GET('parroco'),
                    $pr->__GET('logo'),
                    $pr->__GET('sitio_web')
                ));

            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteParroquia($id)
    {
        try
        {                                              
            $this->myCon = parent::conectar();
            $querySQL = "DELETE FROM dbkermesse.tbl_parroquia WHERE idParroquia = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
        catch (Exception $e) {
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
            $pr = new parroquia();
            
            $pr->__SET('idParroquia', $r->idParroquia);
            $pr->__SET('nombre', $r->nombre);
            $pr->__SET('direccion', $r->direccion);
            $pr->__SET('telefono', $r->telefono);
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