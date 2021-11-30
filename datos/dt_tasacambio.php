<?php

include_once("conexion.php");

class Dt_tasacambio extends Conexion{

  private $myCon;


    public function listatasacambio()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_tasacambio where estado<>3;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $tc = new TasaCambio();

                $tc->__SET('id_tasaCambio', $r->id_tasaCambio);
                $tc->__SET('id_monedaO', $r->id_monedaO);
                $tc->__SET('id_monedaC', $r->id_monedaC);
                $tc->__SET('mes', $r->mes);
                $tc->__SET('anio', $r->anio);
                $tc->__SET('estado', $r->estado);
                
                $result[] = $tc;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function obtenerTasaCambio($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_tasacambio WHERE id_tasaCambio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $tc = new TasaCambio();

            $tc->__SET('id_tasaCambio', $r->id_tasaCambio);
            $tc->__SET('id_monedaO', $r->id_monedaO);
            $tc->__SET('id_monedaC', $r->id_monedaC);
            $tc->__SET('mes', $r->mes);
            $tc->__SET('anio', $r->anio);
            $tc->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $tc;


        }

        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function borrarTc($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "UPDATE dbkermesse.tbl_tasacambio SET estado=3 WHERE id_tasaCambio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
            catch (Exception $e)
            {
                die($e->getMessage());
            }
    }
    public function editTc(TasaCambio $cp)

    {
        try{
            $this->myCon = parent::conectar();
            $sql = "UPDATE dbkermesse.tbl_tasacambio SET
            id_monedaO = ?,
            id_monedaC = ?,
            mes = ?,
            anio = ?,
            estado = ?,
            WHERE id_tasaCambio = ?";

        $this->myCon->prepare($sql)
        ->execute(
            array(
                
                $cp->__GET('id_monedaO'),
                $cp->__GET('id_monedaC'),
                $cp->__GET('mes'),
                $cp->__GET('anio'),
                $cp->__GET('estado'),
                $cp->__GET('id_tasaCambio')
         
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

    public function registrarTc(TasaCambio $cp)
    {
        try
        {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_tasaCambio (id_tasaCambio, id_monedaO, id_monedaC, mes, anio, estado) values (?,?,?,?,?,?)";
            $this->myCon->prepare($sql)
            ->execute(array(
                $cp->__GET('id_tasaCambio'),
                $cp->__GET('id_monedaO'),
                $cp->__GET('id_monedaC'),
                $cp->__GET('mes'),
                $cp->__GET('anio'),
                $cp->__GET('estado')
            ));
            $this->myCon = parent::desconectar();
        }
        catch(Exception $e)
        {
                die($e->getMessage());
        }
    }
}