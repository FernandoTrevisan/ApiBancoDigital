<?php

namespace ApiBancoDigital\DAO;

use ApiBancoDigital\Model\ChavePixModel;
use \PDO;

class ChavePixDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(ChavePixModel $model)
    {
        $sql = "INSERT INTO chave_pix (chave, tipo, id_conta) VALUE (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->id_conta);

        $stmt->execute();
    }

    public function update(ChavePixModel $model)
    {
        $sql = "UPDATE chave_pix SET chave = ?, tipo = ?, id_conta = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->id_conta);
        $stmt->bindValue(4, $model->id);

        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT cp.*, co.nome as conta_nome
                FROM chave_pix cp
                JOIN conta c ON c.id = cp.id_conta
                JOIN correntista co ON co.id = c.id_correntista";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById(int $id)
    {
        $sql = "SELECT cp.*, co.nome as conta_nome
                FROM chave_pix cp
                JOIN conta c ON c.id = cp.id_conta
                JOIN correntista co ON co.id = c.id_correntista
                WHERE cp.id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();

        return $stmt->fetchObject("App\Model\ChavePixModel");
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM chave_pix WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}
