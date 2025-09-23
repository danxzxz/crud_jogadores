<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Time.php");

class TimeDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }
    
    public function listar() {
        $sql = "SELECT * FROM times ORDER BY nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $times = $this->map($resultado);
        return $times;
    }

    private function map($resultado) {
        $times = array();
        foreach($resultado as $r) {
            $time = new Time();
            $time->setId($r['id']);
            $time->setNome($r['nome']);
            $time->setEstado($r['estado']);

            array_push($times, $time);
        }

        return $times;        
    }

}