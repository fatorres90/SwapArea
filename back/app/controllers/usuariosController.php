  
<?php

class UsuariosController{



public function Alta($request, $response, $args){

    $usr=  new Usuarios();

    $listaDeParametros = $request->getParsedBody();
    $usr->Nombre =  $listaDeParametros['Nombre'];
    $usr->Apellido =  $listaDeParametros['Apellido'];
    $usr->NombreUsuario =  $listaDeParametros['NombreUsuario'];
    $usr->Contraseña =  password_hash($listaDeParametros['Contraseña'], PASSWORD_BCRYPT);
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
    $usr->Contraseña =   password_hash($listaDeParametros['pass'], PASSWORD_DEFAULT);
    $usr->nombre =  $listaDeParametros['Nombre'];
    $usr->papellido =  $listaDeParametros['Apellido'];
    $usr->edad =  $listaDeParametros['Edad'];
    $usr->Descripcion =  $listaDeParametros['Descripcion'];
    $usr->UpdateUsuario($usr);
    $response->getBody()->Write("Modificado");
    

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

    //$listaDeParametros = $request->getParsedBody();
    $usr->nombreUsuario = $args['nombreUsuario'];
    $usr->Contraseña =  $args['pass'];
        
    $Contraseñahash = $usr->ObetenerPass($usr);
    

    if(password_verify($args['pass'], $Contraseñahash))
    {
        $usr->Contraseña = "";
        $LisatU = $usr->Login($usr);  
        //$response->getBody()->Write($id);
        $response ->getBody()->Write(json_encode($LisatU));
        
    }
    else
    {

        $usr->idUsuario = "0";
        $response ->getBody()->Write(json_encode( $usr));

    }
    

    return $response->withHeader('Content-Type', 'application/json');


    
}



}


?>