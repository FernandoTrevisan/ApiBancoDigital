<?php

namespace ApiBancoDigital\Controller;

use ApiBancoDigital\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller
{
    public static function entrar()
    {
        //
    }

    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->cpf = $json_obj->Cpf;
            $model->data_nasc = $json_obj->DataNasc;
            $model->senha = $json_obj->Senha;

            $model->save();
        }
        catch (Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function listar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            $model->getAllRows();

            parent::getExceptionAsJSON($model->rows);
        }
        catch (Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function deletar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            $model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id'] : null);
            
            $model->delete();
        }
        catch (Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }
}