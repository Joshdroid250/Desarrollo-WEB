<?php
include_once("conexion.php");

class Dt_Rol extends Conexion
{
    private $myCon;

    public function getIdRol($user)
	{
		try
		{
			$this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT tbl_rol_id_rol FROM dbkermesse.vw_rol_usuario WHERE usuario= :usuario;";

			$stm = $this->myCon->prepare($querySQL);
            $stm->bindParam(':usuario', $user, PDO::PARAM_STR, 40);
			$stm->execute();

            $result = $stm->fetchColumn(0);

			$this->myCon = parent::desconectar();
			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}