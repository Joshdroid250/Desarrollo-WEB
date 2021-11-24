<?php

include_once("conexion.php");

class Dt_moneda extends Conexion{

  private $myCon;

    public function listamoneda()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_moneda;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $gt = new Moneda();

                $gt->__SET('id_moneda', $r->idMoneda);
                $gt->__SET('nombre', $r->nombre);
                $gt->__SET('simbolo', $r->simbolo);
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
    public function obtenermoneda($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_moneda WHERE id_moneda = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $gt = new Moneda();

                $gt->__SET('id_moneda', $r->idMoneda);
                $gt->__SET('nombre', $r->nombre);
                $gt->__SET('simbolo', $r->simbolo);
                $gt->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $gt;


        }
        catch (Exception $prod)
        {
            die($prod->getMessage());
        }
    }

        public function borrarMoneda($id){
            try{
                $this->myCon = parent::conectar();
                $querySQL = "DELETE FROM dbkermesse.tbl_moneda WHERE id_moneda = ?";
                $stm = $this->myCon->prepare($querySQL);
                $stm->execute(array($id));
                $this->myCon = parent::desconectar();
            }
            catch (Exception $e)
            {
                die($e->getMessage());
            }
    }
        public function editMoneda(Moneda $cp)
    
        {
            try{
                $this->myCon = parent::conectar();
                $sql = "UPDATE dbkermesse.tbl_moneda SET
                nombre = ?,
                simbolo = ?,
                estado = ?
                WHERE id_moneda = ?";
    
            $this->myCon->prepare($sql)
            ->execute(
                array(
                    $cp->__GET('id_moneda'),
                    $cp->__GET('nombre'),
                    $cp->__GET('simbolo'),
                    $cp->__GET('estado')
                    
             
                )
                );
                $this->myCon = parent::desconectar();
            }
            catch (Exception $e)
            {
                var_dump($e);
                die($e->getMessage());
            }
        }
    
        public function registrarMoneda(Moneda $cp)
        {
            try
            {
                $this->myCon = parent::conectar();
                $sql = "INSERT INTO dbkermesse.tbl_moneda (id_moneda, nombre, simbolo, estado) values (?,?,?,?)";
                $this->myCon->prepare($sql)
                ->execute(array(
                    $cp->__GET('id_moneda'),
                    $cp->__GET('nombre'),
                    $cp->__GET('simbolo'),
                    $cp->__GET('estado')
                ));
                $this->myCon = parent::desconectar();
            }
        catch (Exception $gt)
        {
            die($gt->getMessage());
        }
    }
}