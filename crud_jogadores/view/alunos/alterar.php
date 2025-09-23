<?php


require_once(__DIR__ . "/../../model/Jogador.php");
require_once(__DIR__ . "/../../controller/JogadorController.php");
require_once(__DIR__ . "/../../controller/PosicaoController.php");
require_once(__DIR__ . "/../../controller/TimeController.php");


$msgErro = "";
$jogador = NULL;
if (isset($_POST['nome'])) {
    //Usuário já clicou no gravar
    $id = $_POST['id'];
    $nome        = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $idade       = is_numeric($_POST['idade']) ? $_POST['idade'] : NULL;
    $estrangeiro = trim($_POST['estrang']) ? trim($_POST['estrang']) : NULL;
    $idPosicao = is_numeric($_POST['id_posicao']) ? $_POST['id_posicao'] : NULL;
    $idTime     = is_numeric($_POST['time']) ? $_POST['time'] : NULL;

    //Criar um objeto Jogador para persistí-lo
    $jogador = new Jogador();
    $jogador-> setId($id);
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
    //Chamar o DAO para salvar o objeto Jogador
    $jogadorCont = new JogadorController();
    $erros = $jogadorCont->Alterar($jogador);

    if(! $erros) {
        //Redirecionar para o listar
        header("location: listar.php");
    } else {
        //Converter o array de erros para string
        $msgErro = implode("<br>", $erros);
    }

} else {

    $id = 0;
    if (isset($_GET['id']))
        $id = $_GET['id'];
}
$jogadorCont = new JogadorController();
$jogador = $jogadorCont->buscarPorId($id);

if (! $jogador) {
    //Redirecionar para o listar
    echo "ID do jogador é inválido!";
    echo "<br><a href='listar.php'>Voltar</a>";
    exit;
}

include_once(__DIR__ . "/form.php");
