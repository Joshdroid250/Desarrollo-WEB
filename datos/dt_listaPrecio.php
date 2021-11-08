<?php
include_once("conexion.php");
class dt_listaPrecio extends Conexion
{
    private $myCon;
    public function listaPrecio()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_lista_precio;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $cg = new listaprecio();

                $cg->__SET('id_lista_precio', $r->id_lista_precio);
                $cg->__SET('id_kermesse', $r->id_kermesse);
                $cg->__SET('nombre', $r->nombre);
                $cg->__SET('descripcion', $r->descripcion);
                
                $result[] = $cg;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerlistaPrecio($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_lista_precio WHERE id_lista_precio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $cg = new listaprecio();
            
                $cg->__SET('id_lista_precio', $r->id_lista_precio);
                $cg->__SET('id_kermesse', $r->id_kermesse);
                $cg->__SET('nombre', $r->nombre);
                $cg->__SET('descripcion', $r->descripcion);

            $this->myCon = parent::desconectar();
            return $cg;


        }

        catch (Exception $cg)
        {
            die($cg->getMessage());
        }
    }
}