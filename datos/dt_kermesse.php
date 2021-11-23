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
            $querySQL = "SELECT * FROM dbkermesse.vw_kermesse_parroquia;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
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

    public function regKermesse(kermesse $kr)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_kermesse (id_kermesse, idParroquia, nombre, fInicio, fFinal, descripcion, estado, usuario_creacion, fecha_creacion)
            VALUES (?,?,?,?,?,?,?,?,?)";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $kr->__GET('id_kermesse'),
                    $kr->__GET('idParroquia'),
                    $kr->__GET('nombre'),
                    $kr->__GET('fInicio'),
                    $kr->__GET('fFinal'),
                    $kr->__GET('descripcion'),
                    $kr->__GET('estado'),
                    $kr->__GET('usuario_creacion'),
                    $kr->__GET('fecha_creacion'),


                ));

            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function editKerme(kermesse $kr)
    {
        try{
            $this->myCon = parent::conectar();
            $sql = "UPDATE dbkermesse.tbl_kermesse SET
            idParroquia = ?,
            nombre = ?,
            fInicio = ?, 
            fFinal = ?, 
            descripcion = ?, 
            estado = ?, 
            usuario_modificacion = ?,
            fecha_modificacion = ? WHERE id_kermesse = ?";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $kr->__GET('idParroquia'),
                    $kr->__GET('nombre'),
                    $kr->__GET('fInicio'),
                    $kr->__GET('fFinal'),
                    $kr->__GET('descripcion'),
                    $kr->__GET('estado'),
                    $kr->__GET('usuario_modificacion'),
                    $kr->__GET('fecha_modificacion'),
                    $kr->__GET('id_kermesse'),
                ));
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function deleteKerme($id)
    {
        try
        {
            $this->myCon = parent::conectar();
            $querySQL = "DELETE FROM dbkermesse.tbl_kermesse WHERE id_kermesse = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }
}