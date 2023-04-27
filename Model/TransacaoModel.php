<?php

namespace ApiBancoDigital\Model;

use ApiBancoDigital\DAO\TransacaoDAO;

class TransacaoModel extends Model
{
    public $id, $data_transacao, $valor, $id_conta_remetente, $id_conta_destinatario;

    public function save()
    {
        $dao = new TransacaoDAO();

        if($this->id == null)
            $dao->insert($this);
        else
            $dao->update($this);
    }

    public function getAllRows()
    {
        $dao = new TransacaoDAO();

        $this->rows = $dao->select();
    }

    public function getById(int $id)
    {
        $dao = new TransacaoDAO();

        $this->rows = $dao->selectById($id);
    }

    public function delete(int $id)
    {
        $dao = new TransacaoDAO();

        $dao->delete($id);
    }
}