<?php

require_once(__DIR__ . "/../dao/JogadorDAO.php");
require_once(__DIR__ . "/../model/Jogador.php");
require_once(__DIR__ . "/../service/JogadorService.php");

class JogadorController {

    private JogadorDAO $jogadorDAO;
    private JogadorService $jogadorService;

    public function __construct() {
        $this->jogadorDAO = new JogadorDAO(); 
        $this->jogadorService = new JogadorService();       
    }

    public function listar() {
        $lista = $this->jogadorDAO->listar();
        return $lista;
    }
        public function buscarPorId($id) {
        $jogador = $this->jogadorDAO->buscarPorId($id);
        return $jogador;
    }

    public function inserir(Jogador $jogador) {
        $erros = $this->jogadorService->validarJogador($jogador);

        if(count($erros) > 0) {
            return $erros;
        }
        //se nao tiver erros, chama o dao
        
        $erro = $this->jogadorDAO->inserir($jogador);
        if($erro) {
            array_push($erros, "Erro ao salvar o jogador!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }

    public function Alterar(Jogador $jogador) {
        $erros = $this->jogadorService->validarJogador($jogador);

        if(count($erros) > 0) 
            return $erros;
        

        //se nao tiver erros, alterar o jogador no banco de dados
        $erro = $this->jogadorDAO->alterar($jogador);
        if($erro) {
            array_push($erros, "Erro ao atualizar o jogador!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }
        return $erros;

    }

    public function excluirPorId(int $id) {
        $erro = $this->jogadorDAO->excluirPorId($id);
        if($erro) {
            array_push($erros, "Erro ao excluir o jogador!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());    
        }
        
        return $erros;
    }
}
    


