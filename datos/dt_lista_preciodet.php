<?php
include_once("conexion.php");
class dt_lista_preciodet extends Conexion
{
    private $myCon;
    public function listaprecioDet()
    {
        try 
        {
           $this->myCon = parent::conectar();
            $result = array();
            $querySQL = "SELECT * FROM dbkermesse.tbl_listaprecio_det;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $lpd = new ListaPrecioDet();

                $lpd->__SET('id_listaprecio_det', $r->id_listaprecio_det);
                $lpd->__SET('id_lista_precio', $r->id_lista_precio);
                $lpd->__SET('id_producto', $r->id_producto);
                $lpd->__SET('precio_venta', $r->precio_venta);
                
                $result[] = $lpd;
            }
            $this ->myCon = parent::desconectar();
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerlistaprecioDet($id){
        try{
            $this->myCon = parent::conectar();
            $querySQL = "SELECT * FROM dbkermesse.tbl_listaprecio_det WHERE id_listaprecio_det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $lpd = new ListaPrecioDet();
            
            $lpd->__SET('id_listaprecio_det', $r->id_listaprecio_det);
            $lpd->__SET('id_lista_precio', $r->id_lista_precio);
            $lpd->__SET('id_producto', $r->id_producto);
            $lpd->__SET('precio_venta', $r->precio_venta);

            $this->myCon = parent::desconectar();
            return $lpd;


        }

        catch (Exception $lpd)
        {
            die($lpd->getMessage());
        }
    }
}