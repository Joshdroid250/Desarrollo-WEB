<?php


class tasaCambio{

private $id_tasacambio;
private $idmonedaO;
private $idmonedaC;
private $mes;
private $anio;
private $estado;


public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}