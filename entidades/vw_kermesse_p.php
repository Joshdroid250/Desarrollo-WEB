<?php

class Vw_kermesse_parroquia{
    //Atributos
    
    private $id_kermesse;
    private $idParroquia;
    private $nomreParro;
    private $nombreKerme;
    private $fInicio;
    private $fFinal;
    private $descripcion;
    private $estado;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    private $usuario_eliminacion;
    private $fecha_eliminacion;

    //Metodos
    public function __GET($k){return $this->$k;}
    public function __SET($k, $v){return $this-> $k = $v;}
}