<?php
class Usuarios {

    public $idUsuario; 
    public $Nombre; 
    public $Apellido; 
    public $NombreUsuario; 
    public $Contraseña; 
    public $Calificacion; 
    public $Mail; 
    public $Edad; 
    public $dni; 
    public $Telefono; 
    public $id_Monedero; 
    public $id_tx; 
    public $id_Domicilio;

    
public function CrearUsuario($usr)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO `usuarios`( `Nombre`, `Apellido`, `NombreUsuario`, `Contraseña`,`Mail`, `Edad`, `dni`, `Telefono`) VALUES ('$usr->Nombre','$usr->Apellido','$usr->NombreUsuario','$usr->Contraseña','$usr->Mail',$usr->Edad,$usr->dni,$usr->Telefono)");
  
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
}


public function UpdateUsuario($usr)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("UPDATE `usuarios` SET `nombreUsuario` =  '$usr->nombreUsuario'  , `pass` = '$usr->pass' , `nombre` = '$usr->nombre' , `Apellido` = '$usr->papellido', `edad` = $usr->edad  ,`Descripcion` = '$usr->Descripcion' WHERE `idUsuario` = $usr->idUsuario");
    
   
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
}
   
public function TodosLosUsaurios()
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("select * from `usuarios`");
    
    // $this->autor;
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuarios');
}

    
public function EliminarUsuario($usr)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM `usuarios` WHERE `idUsuario` = $usr->idUsuario  ");
    
    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');
}

public function Login($usr)
{

    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("SELECT `idUsuario`  FROM `usuarios` WHERE `nombreUsuario` = '$usr->nombreUsuario' AND `pass` = '$usr->pass' ");
    
    // $this->autor;
    $consulta->execute();
    $filas = $consulta->rowCount(); 
     
    if($filas>0)
    {

       $usu = $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuarios');

    return strval($usu[0]->idUsuario);
    }
    else
    {

    return "0";
    }
    
}


}





$usuarios = new Usuarios;
?>