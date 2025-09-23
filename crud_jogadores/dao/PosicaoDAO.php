<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Posicao.php");

class PosicaoDAO {
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM posicoes ORDER BY nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $posicoes = array();
        foreach($resultado as $r) {
            $posicao = new Posicao();
            $posicao->setId($r['id']);
            $posicao->setNome($r['nome']);
            $posicoes[] = $posicao;
        }
        return $posicoes;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM posicoes WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $r = $stm->fetch();
        if ($r) {
            $posicao = new Posicao();
            $posicao->setId($r['id']);
            $posicao->setNome($r['nome']);
            return $posicao;
        }
        return null;
    }

    public function inserir(Posicao $posicao) {
        $sql = "INSERT INTO posicoes (nome) VALUES (?)";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$posicao->getNome()]);
    }

    public function alterar(Posicao $posicao) {
        $sql = "UPDATE posicoes SET nome = ? WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$posicao->getNome(), $posicao->getId()]);
    }

    public function excluirPorId($id) {
        $sql = "DELETE FROM posicoes WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([$id]);
    }
}