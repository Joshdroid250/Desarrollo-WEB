<?php


class comunidad{

private $id_comunidad_INT;
private $nombre;
private $responsable;
private $desc_contribucion;
private $estado;



public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
} 