<?php

class Usuario
{
    //Atributos
	private $id_usuario;
	private $usuario;
    private $pwd;
    private $nombres;
    private $apellidos;
    private $email;
    private $estado;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_edicion;
    private $fecha_edicion;
    private $usuario_eliminacion;
    private $fecha_eliminacion;
	
    //METODOS
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }

}