<?php

require_once(__DIR__ . "/../../model/Jogador.php");
require_once(__DIR__ . "/../../controller/JogadorController.php");
require_once(__DIR__ . "/../../controller/TimeController.php");
require_once(__DIR__ . "/../../controller/PosicaoController.php");

$msgErro = "";
$jogador = NULL;

//Receber os dados do formulário
if(isset($_POST['nome'])) {
    //Usuário já clicou no gravar
    $nome        = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $idade       = is_numeric($_POST['idade']) ? $_POST['idade'] : NULL;
    $estrangeiro = trim($_POST['estrang']) ? trim($_POST['estrang']) : NULL;
    $idTime     = is_numeric($_POST['time']) ? $_POST['time'] : NULL;
    $idPosicao = is_numeric($_POST['id_posicao']) ? $_POST['id_posicao'] : NULL;

    //Criar um objeto Jogador para persistí-lo
    $jogador = new Jogador();
    $jogador->setId(0);
    $jogador->setNome($nome);
    $jogador->setIdade($idade);
    $jogador->setEstrangeiro($estrangeiro);

    $time = new Time();
    $time->setId($idTime);
    $jogador->setTime($time);
    //print_r($jogador);

    $posicao = new Posicao();
    $posicao->setId($idPosicao);
    $jogador->setPosicao($posicao);

    $posicaoCont = new PosicaoController();
    $listaPosicoes = $posicaoCont->listar();

    //Chamar o DAO para salvar o objeto Jogador
    $jogadorCont = new JogadorController();
    $erros = $jogadorCont->inserir($jogador);

    if(! $erros) {
        //Redirecionar para o listar
        header("location: listar.php");
    } else {
        //Converter o array de erros para string
        $msgErro = implode("<br>", $erros);
    }
}

include_once(__DIR__ . "/form.php");
?>