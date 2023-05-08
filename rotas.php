<?php

use ApiBancoDigital\Controller\
{
    ChavePixController,
    ContaController,
    CorrentistaController,
    TransacaoController
};


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/correntista/save':
        CorrentistaController::save();
    break;

    case '/conta/extrato':
        ContaController::extrato();
    break;

    case '/conta/pix/enviar':
        ContaController::EnviarPix();
    break;

    case '/conta/pix/receber':
        ContaController::ReceberPix();
    break;

    case '/correntista/entrar':
        CorrentistaController::entrar();
    break;

    
    default:
        http_response_code(403);
    break;
}
