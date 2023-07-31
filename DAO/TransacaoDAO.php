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
        
        $sql = "INSERT INTO Reclamacao 
                            (id_categoria, id_cidadao, id_bairro, descricao, titulo, endereco, latitude, longitude, foto) 
                VALUES 
                            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";


        
        $stmt = $this->conexao->prepare($sql);


        
        $stmt->bindValue(1, $model->id_categoria);
        $stmt->bindValue(2, $model->id_cidadao);
        $stmt->bindValue(3, $model->id_bairro);
        $stmt->bindValue(4, $model->descricao);
        $stmt->bindValue(5, $model->titulo);
        $stmt->bindValue(6, $model->endereco);
        $stmt->bindValue(7, $model->latitude);
        $stmt->bindValue(8, $model->longitude);
        $stmt->bindValue(9, $model->foto);

         
        return $stmt->execute();
    }


    
    public function select(int $id_cidadao)
    {
        $sql = "SELECT * FROM Reclamacao WHERE id_cidadao = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cidadao);
        $stmt->execute();

        
        return $stmt->fetchAll(PDO::FETCH_CLASS);        
    }


}