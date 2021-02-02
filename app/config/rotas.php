<?php

// Erro 404
$Rotas->onError("404", function (){
   echo "Erro - 404";
});



/** ============================================================ *
 * API ========================================================= */


// Usuario
$Rotas->group("api-usuario","api/usuario","Api\Usuario");
$Rotas->onGroup("api-usuario","POST","login","login");
$Rotas->onGroup("api-usuario","GET","get","getAll");
$Rotas->onGroup("api-usuario","GET","get/{p}","get");
$Rotas->onGroup("api-usuario","POST","insert","insert");
$Rotas->onGroup("api-usuario","PUT","update/{p}","update");
$Rotas->onGroup("api-usuario","DELETE","delete/{p}","delete");


// Categoria
$Rotas->group("api-categoria","api/categoria","Api\Categoria");
$Rotas->onGroup("api-categoria","GET","get","getAll");
$Rotas->onGroup("api-categoria","GET","get/{p}","get");
$Rotas->onGroup("api-categoria","POST","insert","insert");
$Rotas->onGroup("api-categoria","PUT","update/{p}","update");
$Rotas->onGroup("api-categoria","DELETE","delete/{p}","delete");


// Fornecedor
$Rotas->group("api-fornecedor","api/fornecedor","Api\Fornecedor");
$Rotas->onGroup("api-fornecedor","GET","get","getAll");
$Rotas->onGroup("api-fornecedor","GET","get/{p}","get");
$Rotas->onGroup("api-fornecedor","POST","insert","insert");
$Rotas->onGroup("api-fornecedor","PUT","update/{p}","update");
$Rotas->onGroup("api-fornecedor","DELETE","delete/{p}","delete");


// Modelo
$Rotas->group("api-modelo","api/modelo","Api\Modelo");
$Rotas->onGroup("api-modelo","GET","get","getAll");
$Rotas->onGroup("api-modelo","GET","get/{p}","get");
$Rotas->onGroup("api-modelo","POST","insert","insert");
$Rotas->onGroup("api-modelo","PUT","update/{p}","update");
$Rotas->onGroup("api-modelo","DELETE","delete/{p}","delete");
