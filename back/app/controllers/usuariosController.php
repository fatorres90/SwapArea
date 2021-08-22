  
<?php

class UsuariosController{



public function Alta($request, $response, $args){

    $usr=  new Usuarios();

    $listaDeParametros = $request->getParsedBody();
    $usr->Nombre =  $listaDeParametros['Nombre'];
    $usr->Apellido =  $listaDeParametros['Apellido'];
    $usr->NombreUsuario =  $listaDeParametros['NombreUsuario'];
    $usr->Contraseña =  $listaDeParametros['Contraseña'];
    $usr->Mail =  $listaDeParametros['Mail'];
    $usr->Edad =  $listaDeParametros['Edad'];
    $usr->dni =  $listaDeParametros['dni'];
    $usr->Telefono =  $listaDeParametros['Telefono'];
    $usr->CrearUsuario($usr);
    $response->getBody()->Write("Usuario Creado");
    
    return $response ;
}

public function Baja($request, $response, $args){

    $usr=  new Usuarios();
    $listaDeParametros = $request->getParsedBody();
    $usr->idUsuario =  $listaDeParametros['idUsuario'];

    $usr->EliminarUsuario($usr);
    $response->getBody()->Write("Eliminado");
    return $response;
}

public function Modificacion($request, $response, $args){

    $usr=  new Usuarios();

    
    $listaDeParametros = $request->getParsedBody();
    $usr->idUsuario =  $listaDeParametros['idUsuario'];
    $usr->nombreUsuario =  $listaDeParametros['NUsuario'];
    $usr->pass =  $listaDeParametros['pass'];
    $usr->nombre =  $listaDeParametros['Nombre'];
    $usr->papellido =  $listaDeParametros['Apellido'];
    $usr->edad =  $listaDeParametros['Edad'];
    $usr->Descripcion =  $listaDeParametros['Descripcion'];
    $usr->UpdateUsuario($usr);
    $response->getBody()->Write("Creado");
    

    return $response;
}
public function Listar($request, $response, $args){

   $usr=  new Usuarios();
   $arrayUsuarios = $usr->TodosLosUsaurios();
   $response ->getBody()->Write(json_encode($arrayUsuarios));
 

  return $response->withHeader('Content-Type', 'application/json');
}

public function Login($request, $response, $args){
     
    $usr=  new Usuarios();

    $listaDeParametros = $request->getParsedBody();
    $usr->nombreUsuario =  $listaDeParametros['NUsuario'];
    $usr->pass =  $listaDeParametros['pass'];

    $id = $usr->Login($usr);
     
    
    $response->getBody()->Write($id);
    

    return $response;
     //$response ->getBody()->Write(json_encode($usuario));
           //$response->getBody()->Write("OK");
    // return $response->withHeader('Content-Type', 'application/json');


    
}



}


?>