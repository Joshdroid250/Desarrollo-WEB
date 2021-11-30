<?php
include_once("conexion.php");
 
class Dt_opciones extends Conexion{
    private $myCon;
    public function listOpciones(){
        try
        {
            $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_opciones WHERE estado <> 3;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)  {
                $opc = new Opciones();
                $opc->__SET('id_opciones',$r->id_opciones);
                $opc->__SET('opcion_descripcion',$r->opcion_descripcion);
                $opc->__SET('estado',$r->estado);
                $result[] = $opc;
            }
            $this->myCon = parent::desconectar();
            return $result;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    
    public function RegistrarOpc(Opciones $opc){
        try
        {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_opciones (id_opciones,opcion_descripcion,estado)
            VALUES (?,?,?)";

            $this->myCon->prepare($sql)
             ->execute(array(
                $opc->__GET('id_opciones'),
                $opc->__GET('opcion_descripcion'),
                $opc->__GET('estado')
             ));

             $this->myCon = parent::desconectar();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

    }

    public function editOpc(Opciones $opc)
    {
        try
        {
            $this->myCon = parent::conectar();
            $sql = "UPDATE dbkermesse.tbl_opciones SET
            opcion_descripcion = ?,
            estado = ?
            WHERE id_opciones = ?;";

            $this->myCon->prepare($sql)
             ->execute(
            array(
                $opc->__GET('opcion_descripcion'),
                $opc->__GET('estado'),
                $opc->__GET('id_opciones')
             )
            );
             $this->myCon = parent::desconectar();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

    }

    public function obtenerOpc($id)
    {
        try
        {   
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_opciones WHERE id_opciones = ?;";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);

            $opc = new Opciones();

            $opc->__SET('id_opciones', $r->id_opciones);
            $opc->__SET('opcion_descripcion', $r->opcion_descripcion);
            $opc->__SET('estado', $r->estado);

            $this->myCon = parent::desconectar();
            return $opc;
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function getOpciones($rol)
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT opcion_descripcion FROM dbkermesse.vw_rol_opciones WHERE tbl_rol_id_rol= :id_rol;";

			$stm = $this->myCon->prepare($querySQL);
            $stm->bindParam(':id_rol', $rol, PDO::PARAM_INT);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$opc = new Opciones();
				//_SET(CAMPOBD, atributoEntidad)			
				$opc->__SET('opcion_descripcion', $r->opcion_descripcion);		
				$result[] = $opc;
				//var_dump($result);
			}
			$this->myCon = parent::desconectar();
			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


    public function deleteOpc($idOp)
    {
        try
        {
            $this->myCon = parent::conectar();
            $querySQL = "UPDATE dbkermesse.tbl_opciones SET estado = 3 WHERE id_opciones = ?;";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($idOp));

            $this->myCon = parent::desconectar();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
}