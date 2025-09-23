<?php

require_once(__DIR__ . "/../dao/PosicaoDAO.php");
require_once(__DIR__ . "/../model/Posicao.php");

class PosicaoController {

    private PosicaoDAO $posicaoDAO;

    public function __construct() {
        $this->posicaoDAO = new PosicaoDAO();
    }

    public function listar() {
        return $this->posicaoDAO->listar();
    }

    public function buscarPorId($id) {
        return $this->posicaoDAO->buscarPorId($id);
    }
}