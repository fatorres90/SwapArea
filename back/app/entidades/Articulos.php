<?php
class Articulos {
    public $idArticulo;
    public $nombreArticulo;
    public $Descripcion;
    public $idUsuario;
    public $foto;


    
public function CrearArticulo($art)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO `Articulos`(`nombreArticulo`, `Descripcion`, `idUsuario`, `foto`) VALUES ('$art->nombreArticulo', '$art->Descripcion', '$art->idUsuario', '$art->foto')");
    
   
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Articulos');
}


public function UpdateUsuario($usr)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("UPDATE `usuarios` SET `NumbreUsuario` =  '$usr->nombreUsuario'  , `pass` = '$usr->pass' , `nombre` = '$usr->nombre' , `Apellido` = '$usr->papellido', `edad` = $usr->edad  ,`Descripcion` = '$usr->Descripcion' WHERE `idUsuario` = $usr->idUsuario");
    
  
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
}
   
public function TodosLosArticulos()
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("select * from `usuarios`");
    
   
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuarios');
}

    
public function EliminarArticulo($art)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM `Articulos` WHERE `idArticulo` = $art->idArticulo  ");
  
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
}




}




$artuculo = new Articulos;
?>