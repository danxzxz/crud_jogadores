<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/jogador.php");
require_once(__DIR__ . "/../model/Posicao.php");
require_once(__DIR__ . "/../model/Time.php");

class JogadorDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }

   public function listar() {
    $sql = "SELECT a.*, 
                c.nome nome_time, c.estado estado_time,
                p.nome nome_posicao
            FROM jogadores a
                JOIN times c ON (c.id = a.id_time)
                JOIN posicoes p ON (p.id = a.id_posicao)";
    $stm = $this->conexao->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll();

    return $this->map($result);
}

public function buscarPorId($id) {
    $sql = "SELECT a.*, 
                c.nome nome_time, c.estado estado_time,
                p.nome nome_posicao
            FROM jogadores a
                JOIN times c ON (c.id = a.id_time)
                JOIN posicoes p ON (p.id = a.id_posicao)
            WHERE a.id = ?";
    $stm = $this->conexao->prepare($sql);
    $stm->execute([$id]);
    $result = $stm->fetchAll();

    $jogadores = $this->map($result);
    if(count($jogadores) > 0) {
        return $jogadores[0];
    }else {
        return NULL;
    }
}

    public function inserir(Jogador $jogador) {
        try {
            $sql = "INSERT INTO jogadores (nome, idade, estrangeiro, id_time, id_posicao)
                    VALUES (?, ?, ?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$jogador->getNome(), $jogador->getIdade(), 
                        $jogador->getEstrangeiro(),
                        $jogador->getTime()->getId(),
                         $jogador->getPosicao()->getId()]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    }
    
    public function alterar(Jogador $jogador) {
          try {
            $sql = "UPDATE jogadores 
                    SET nome = ?, idade = ?, estrangeiro = ?, id_time = ?, id_posicao = ?
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$jogador->getNome(), $jogador->getIdade(), 
                        $jogador->getEstrangeiro(),
                        $jogador->getTime()->getId(),
                        $jogador->getPosicao()->getId(),
                    $jogador->getId()]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    
    }

      public function excluirPorId(int $id) {
          try {
            $sql = "DELETE FROM jogadores 
                    WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$id]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    
    }

    private function map(array $result) {
        $jogadores = array();
        foreach($result as $r) {
            $jogador = new Jogador();
            $jogador->setId($r["id"]);
            $jogador->setNome($r['nome']);
            $jogador->setIdade($r["idade"]);
            $jogador->setEstrangeiro($r['estrangeiro']);
            
            $time = new Time();
            $time->setId($r["id_time"]);
            $time->setNome($r["nome_time"]);
            $time->setEstado($r["estado_time"]);
            $jogador->setTime($time);

            $posicao = new Posicao();
            $posicao->setId($r["id_posicao"]);
            $posicao->setNome($r["nome_posicao"]);
            $jogador->setPosicao($posicao);

            array_push($jogadores, $jogador);
        }
        return $jogadores;
    }

}