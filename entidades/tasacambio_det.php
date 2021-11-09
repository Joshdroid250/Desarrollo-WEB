<?php


class tasaCambiodet{

private $id_tasacambio_det;
private $id_tasacambio;
private $fecha;
private $tipoCambio;
private $estado;


public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}