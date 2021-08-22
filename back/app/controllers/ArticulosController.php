<?php

class ArticulosController{



public function Alta($request, $response, $args){

    $Art=  new Articulos();


    $listaDeParametros = $request->getParsedBody();
    $Art->nombreArticulo =  $listaDeParametros['nombreArticulo'];
    $Art->Descripcion =  $listaDeParametros['Descripcion'];
    $Art->idUsuario =  $listaDeParametros['idUsuario'];
    $Art->foto =  $listaDeParametros['foto'];
    $Art->CrearArticulo($Art);
    $response->getBody()->Write("Creado");
    
    return $response ;
}

public function Baja($request, $response, $args){

    $Art=  new Articulos();
    $listaDeParametros = $request->getParsedBody();
    $usr->idUsuario =  $listaDeParametros['idArticulo'];

    $usr->EliminarArticulo($usr);
    $response->getBody()->Write("Eliminado");
    return $response;
}

public function Modificacion($request, $response, $args){

    $Art=  new Articulos();

    
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

   $Art=  new Articulos();
   $arrayUsuarios = $usr->TodosLosUsaurios();
   $response ->getBody()->Write(json_encode($arrayUsuarios));
 

  return $response->withHeader('Content-Type', 'application/json');
}




}


?>