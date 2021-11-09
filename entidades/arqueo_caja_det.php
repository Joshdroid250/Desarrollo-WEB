<?php


class arqueoCaja_det{

private $idArqueoCaja_det;
private $id_arqueo_caja;
private $idMoneda;
private $idDenominacion;
private $cantidad;
private $subtotal;


public function __GET($k){return $this ->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}