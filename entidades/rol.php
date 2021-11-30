<?php

class Rol
{
    //Atributos
	private $id_rol;
	private $rol_descripcion;
    private $estado;
	
    //METODOS
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }

}