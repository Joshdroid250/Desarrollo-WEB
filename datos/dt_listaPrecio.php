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
            $querySQL = "SELECT * FROM dbkermesse.vw_listaprecio_kermesse;";

            $stm = $this->myCon->prepare($querySQL);
            $stm->execute();
            
            foreach($stm->fetchAll(PDO::FETCH_OBJ)as $r)
            {
                $lp = new listaprecio();

                $lp->__SET('id_lista_precio', $r->id_lista_precio);
                $lp->__SET('id_kermesse', $r->id_kermesse);
                $lp->__SET('nombreKermesse', $r->nombreKermesse);
                $lp->__SET('nombre', $r->nombre);
                $lp->__SET('descripcion', $r->descripcion);
                
                $result[] = $lp;
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
            $querySQL = "SELECT * FROM dbkermesse.vw_listaprecio_kermesse WHERE id_lista_precio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));

            $r=$stm->fetch(PDO::FETCH_OBJ);
            $lp = new listaprecio();
            
                $lp->__SET('id_lista_precio', $r->id_lista_precio);
                $lp->__SET('id_kermesse', $r->id_kermesse);
                $lp->__SET('nombreKermesse', $r->nombreKermesse);
                $lp->__SET('nombre', $r->nombre);
                $lp->__SET('descripcion', $r->descripcion);

            $this->myCon = parent::desconectar();
            return $lp;


        }

        catch (Exception $lp)
        {
            die($lp->getMessage());
        }
    }
    
    public function regListaPrecio(listaPrecio $lstPrecio)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "INSERT INTO dbkermesse.tbl_lista_precio (id_lista_precio, id_kermesse, nombre, descripcion, estado)
            VALUES (?,?,?,?,?)";
            $this->myCon->prepare($sql)
                ->execute(array(

                    $lstPrecio->__GET('id_lista_precio'),
                    $lstPrecio->__GET('id_kermesse'),
                    $lstPrecio->__GET('nombre'),
                    $lstPrecio->__GET('descripcion'),
                    $lstPrecio->__GET('estado')
                ));

            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function editListaPrecio(listaPrecio $lstPrecio)
    {
        try {
            $this->myCon = parent::conectar();
            $sql = "UPDATE tbl_lista_precio SET
            id_kermesse = ?,
            nombre = ?,
            descripcion = ?,
            estado = ? WHERE id_lista_precio = ?";
            $this->myCon->prepare($sql)
                ->execute(array(
                    $lstPrecio->__GET('id_kermesse'),
                    $lstPrecio->__GET('nombre'),
                    $lstPrecio->__GET('descripcion'),
                    $lstPrecio->__GET('estado'),
                    $lstPrecio->__GET('id_lista_precio'),

                ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function deleteLista($id)
    {
        try {
            $this->myCon = parent::conectar();
            $querySQL = "DELETE FROM tbl_lista_precio WHERE id_lista_precio = ?";
            $stm = $this->myCon->prepare($querySQL);
            $stm->execute(array($id));
            $this->myCon = parent::desconectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}