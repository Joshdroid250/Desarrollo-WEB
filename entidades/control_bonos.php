<?php


class control_bonos{

private $id_bono;
private $nombre;
private $valor;
private $estado;



public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
} 