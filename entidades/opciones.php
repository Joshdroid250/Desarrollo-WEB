<?php


class Opciones{

private $id_opciones;
private $opciones_descripcion;
private $estado;


public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
