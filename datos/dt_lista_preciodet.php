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
            $querySQL = "SELECT * FROM dbkermesse.vw_listapreciodet_listaprecio_producto;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $lpd = new ListaPrecioDet();

                $lpd->__SET('id_listaprecio_det', $r->id_listaprecio_det);
                $lpd->__SET('id_lista_precio', $r->id_lista_precio);
                $lpd->__SET('id_producto', $r->id_producto);
                $lpd->__SET('nombrProducto', $r->nombrProducto);
                $lpd->__SET('nombreListaPrecio', $r->nombreListaPrecio);
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
            $querySQL = "SELECT * FROM dbkermesse.vw_listapreciodet_listaprecio_producto WHERE id_listaprecio_det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $lpd = new ListaPrecioDet();
            
            $lpd->__SET('id_listaprecio_det', $r->id_listaprecio_det);
            $lpd->__SET('id_lista_precio', $r->id_lista_precio);
            $lpd->__SET('id_producto', $r->id_producto);
            $lpd->__SET('nombrProducto', $r->nombrProducto);
            $lpd->__SET('nombreListaPrecio', $r->nombreListaPrecio);
            $lpd->__SET('precio_venta', $r->precio_venta);

            $this->myCon = parent::desconectar();
            return $lpd;


        }

        catch (Exception $lpd)
        {
            die($lpd->getMessage());
        }
    }
    public function regListaPrecioDet(listaprecioDet $lstPrecio)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_listaprecio_det (id_listaprecio_det, id_lista_precio, id_producto, precio_venta)
            VALUES (?,?,?,?)";
            $this->myCon->prepare($sql)
                ->execute(array(

                    $lstPrecio->__GET('id_listaprecio_det'),
                    $lstPrecio->__GET('id_lista_precio'),
                    $lstPrecio->__GET('id_producto'),
                    $lstPrecio->__GET('precio_venta'),
                ));

            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function editListaPrecioDet(listaprecioDet $lstPrecio)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "UPDATE tbl_listaprecio_det SET
            id_lista_precio = ?,
            id_producto = ?,
            precio_venta = ? WHERE id_listaprecio_det = ?";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $lstPrecio->__GET('id_lista_precio'),
                    $lstPrecio->__GET('id_producto'),
                    $lstPrecio->__GET('precio_venta'),
                    $lstPrecio->__GET('id_listaprecio_det'),
                ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function deleteList($id)
    {
        try
        {
            $this->myCon = parent::conectar();
            $querySQL = "DELETE FROM dbkermesse.tbl_listaprecio_det WHERE id_listaprecio_det = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
