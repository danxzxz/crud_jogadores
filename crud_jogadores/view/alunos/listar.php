<?php
    require_once(__DIR__ . "/../../controller/JogadorController.php");   

    //Chamar o controller para obter a lista de jogadores
    $jogadorCont = new JogadorController();
    $lista = $jogadorCont->listar();

    //print_r($lista);


    //Incluir o header
    include_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de Jogadors</h3> 

<div>
    <a href="inserir.php">Inserir</a>
</div>

<table class="table table-striped">
    <!-- Cabeçalho -->
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Estrangeiro</th>
        <th>Time</th>
        <th>Posicao</th>
        <th></th>
        <th></th>

    </tr>

    <!-- Dados -->
    <?php foreach($lista as $jogador): ?>
        <tr>
            <td><?= $jogador->getId() ?></td>
            <td><?= $jogador->getNome() ?></td>
            <td><?= $jogador->getIdade() ?></td>
            <td><?= $jogador->getEstrangeiroTexto() ?></td>
            <td><?= $jogador->getTime() ?></td>
            <td><?= $jogador->getPosicao() ? $jogador->getPosicao()->getNome() : '' ?></td>
            <td>
                <a href="alterar.php?id=<?= $jogador->getId() ?>">
                    <img src="../../img/btn_editar.png" alt="">
                </a>
            </td>
            <td><a href="excluir.php?id=<?= $jogador->getId() ?>" onclick="return confirm('Confirma a exclusao?')">
                    <img src="../../img/btn_excluir.png" alt="">
                </a></td>
        </tr>
    <?php endforeach; ?>


</table>

<?php
    //Incluir o footer
    include_once(__DIR__ . "/../include/footer.php");   
?>
    
