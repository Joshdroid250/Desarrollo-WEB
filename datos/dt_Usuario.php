<?php
include_once("conexion.php");

class Dt_Usuario extends Conexion
{
    private $myCon;

    public function listUser()
	{
		try
		{
            $this->myCon = parent::conectar();
			$result = array();
			$querySQL = "SELECT * FROM hr.tbl_usuario where estado <> 3;";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$reg = new Usuario();

				//_SET(CAMPOBD, atributoEntidad)			
				$reg->__SET('id_usuario', $r->id_usuario);
				$reg->__SET('usuario', $r->usuario);
                $reg->__SET('nombres', $r->nombres);
                $reg->__SET('apellidos', $r->apellidos);
                $reg->__SET('email', $r->email);
                $reg->__SET('estado', $r->estado);						
				$result[] = $reg;
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

    public function insertUser(Usuario $u)
	{
		try 
		{
			$this->myCon = parent::conectar();
			/*date_default_timezone_set("America/Managua");
			$fecha = date('Y-m-d H:i:s');

			$sql = "INSERT INTO hr.tbl_usuario (usuario,pwd,nombres,apellidos,email,estado,usuario_creacion,fecha_creacion) 
		        VALUES (?, ?, ?, ?, ?, 1, 1, '$fecha')";*/

			$sql = "INSERT INTO hr.tbl_usuario (usuario,pwd,nombres,apellidos,email,estado,usuario_creacion,fecha_creacion) 
		        VALUES (?, ?, ?, ?, ?, 1, 1, now())";

			$this->myCon->prepare($sql)
		     ->execute(array(
			 $u->__GET('usuario'),
			 $u->__GET('pwd'),
             $u->__GET('nombres'),
             $u->__GET('apellidos'),
			 $u->__GET('email')));
			
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function deleteUser($idU)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "UPDATE dbkermesse.tbl_usuario SET estado=3, usuario_eliminacion=1, fecha_eliminacion=now()  WHERE id_usuario = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($idU));
			$this->myCon = parent::desconectar();
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerUser($user)
	{
		try 
		{
			$this->myCon = parent::conectar();
			$querySQL = "SELECT * FROM tbl_usuario WHERE usuario = ?";
			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($user));
			
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$us = new Usuario();

			//_SET(CAMPOBD, atributoEntidad)			
			$us->__SET('id_usuario', $r->id_usuario);
			$us->__SET('usuario', $r->usuario);
			$us->__SET('nombres', $r->nombres);
			$us->__SET('apellidos', $r->apellidos);
			$us->__SET('email', $r->email);
			$us->__SET('estado', $r->estado);	


			$this->myCon = parent::desconectar();
			return $us;
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function validarUser($user, $pwd)
	{
		try
		{
			$this->myCon = parent::conectar();
			
			$querySQL = "SELECT * FROM dbkermesse.tbl_usuario WHERE usuario=? AND pwd=? AND estado<>3;";

			$stm = $this->myCon->prepare($querySQL);
			$stm->execute(array($user, $pwd));
			
			$resultado = $stm->fetchAll(PDO::FETCH_CLASS, "Usuario");
			
			$this->myCon = parent::desconectar();
			return $resultado;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

}
