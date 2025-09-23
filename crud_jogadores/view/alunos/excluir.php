<?php

require_once(__DIR__ . "/../../model/Jogador.php");
require_once(__DIR__ . "/../../controller/JogadorController.php");

//1- receber o id do jogador(get)
$id = 0;
if (isset($_GET['id']))
    $id = $_GET['id'];  

//2- chamar o controller para excluir
$jogadorCont = new JogadorController();
$jogador = $jogadorCont->buscarPorId($id);  
if($jogador) {
    $jogadorCont->excluirPorId($jogador->getId());


//3- verifica se deu erro
if($erros){
    //3.1- se deu erro, exibe mensagem
    $msgErros = implode("<br>", $erros);
    // foreach($erros as $erro) {
    //     echo "<p class='alert alert-danger'>$erro</p>";
    // }
}else{
    //3.2- se nao deu erro, redireciona para a lista de jogadores
    header("Location: listar.php");
    exit();
}
} else {
   
    echo "<p class='alert alert-danger'>Jogador não encontrado!</p>";
    echo "<p><a href='listar.php'>Voltar</a></p>";
    }