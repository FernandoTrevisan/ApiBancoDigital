<?php

namespace ApiBancoDigital\DAO;

use ApiBancoDigital\Model\TransacaoModel;
use \PDO;

class TransacaoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(TransacaoModel $model)
    {
        $sql = "INSERT INTO transacao (data_transacao, valor, id_conta_remetente, id_conta_destinatario) VALUE (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->data_transacao);        
        $stmt->bindValue(2, $model->valor);        
        $stmt->bindValue(3, $model->id_conta_remetente);     
        $stmt->bindValue(4, $model->id_conta_destinatario);               

        $stmt->execute();
    }

    public function update(TransacaoModel $model)
    {
        $sql = "UPDATE transacao SET data_transacao = ?, valor = ?, id_conta_remetente = ?, id_conta_destinatario = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
   
        $stmt->bindValue(1, $model->data_transacao);
        $stmt->bindValue(2, $model->valor);
        $stmt->bindValue(3, $model->id_conta_remetente);
        $stmt->bindValue(4, $model->id_conta_destinatario);
        $stmt->bindValue(5, $model->id);

        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT t.*, corr1.nome as nome_remetente, corr2.nome as nome_recebeu
                FROM transacao t
                JOIN conta c1 ON c1.id = t.id_conta_remetente
                JOIN correntista co1 ON co1.id = corr1.id_correntista
                JOIN conta c2 ON c2.id = t.id_conta_destinatario
                JOIN correntista co2 ON co2.id = coor2.id_correntista";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById(int $id)
    {
        $sql = "SELECT t.*, corr1.nome as nome_remetente, corr2.nome as nome_recebeu
                FROM transacao t
                JOIN conta c1 ON c1.id = t.id_conta_remetente
                JOIN correntista co1 ON co1.id = corr1.id_correntista
                JOIN conta c2 ON c2.id = t.id_conta_destinatario
                JOIN correntista co2 ON co2.id = coor2.id_correntista
                WHERE t.id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
                
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM transacao WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        
        $stmt->execute();
    }
}