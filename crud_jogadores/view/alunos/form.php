<?php
require_once(__DIR__ . "/../../controller/PosicaoController.php");
require_once(__DIR__ . "/../../controller/TimeController.php");

$timeCont = new TimeController();
$times = $timeCont->listar();
//print_r($times);

$posicaoCont = new PosicaoController();
$listaPosicoes = $posicaoCont->listar();
include_once(__DIR__ . "/../include/header.php");
?>

<h3><?= $jogador && $jogador->getId() > 0 ? 'Alterar' : 'Inserir' ?> jogador</h3>

<div class="row">
    <div class="col-6">

        <form method="POST" action="">

            <div>
                <label for="txtNome" class="form-label">Nome:</label>
                <input type="text" id="txtNome" name="nome"
                    placeholder="Informe o nome" class="form-control"
                    value="<?= $jogador ? $jogador->getNome() : '' ?>">
            </div>

            <div>
                <label for="txtIdade" class="form-label">Idade:</label>
                <input type="number" id="txtIdade" name="idade"
                    placeholder="Informe a idade" class="form-control"
                    value="<?= $jogador ? $jogador->getIdade() : '' ?>">
            </div>

            <div>
                <label for="selEstrang" class="form-label">Estrangeiro:</label>
                <select name="estrang" id="selEstrang" class="form-select">
                    <option value="">----Selecione----</option>
                    <option value="S" <?= $jogador && $jogador->getEstrangeiro() == 'S' ? 'selected' : '' ?>> Sim</option>
                    <option value="N" <?= $jogador && $jogador->getEstrangeiro() == 'N' ? 'selected' : '' ?>> Não</option>
                </select>
            </div>

            <div>
                <label for="selTime" class="form-label">Time:</label>
                <select name="time" id="selTime" class="form-select">
                    <option value="">----Selecione----</option>
                    <?php foreach ($times as $c): ?>
                        <option value="<?= $c->getId() ?>"

                            <?php if ($jogador && $jogador->getTime() && $jogador->getTime()->getId() == $c->getId())
                                echo "selected";
                            ?>>

                            <?= $c ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="selPosicao" class="form-label">Posição:</label>
                <select name="id_posicao" id="selPosicao" class="form-select" required>
                    <option value="">----Selecione----</option>
                    <?php foreach ($listaPosicoes as $posicao): ?>
                        <option value="<?= $posicao->getId() ?>"
                            <?php if ($jogador && $jogador->getPosicao() && $jogador->getPosicao()->getId() == $posicao->getId())
                                echo "selected";
                            ?>>
                            <?= $posicao->getNome() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id"
                value="<?= $jogador ? $jogador->getId() : 0 ?>">


            <div class="mt-3">
                <button type="submit" class="btn btn-success">Gravar</button>
            </div>

        </form>
 </div>
     <div class="col-6">  
        <?php if($msgErro) : ?>
        <div class="alert alert-danger ">
            <?= $msgErro ?>
        </div>
        <?php endif; ?>
    </div> 
</div>
<div class="mt-2">
    <a href="listar.php" class="btn btn-outline-primary">Voltar</a>
</div>


<?php
include_once(__DIR__ . "/../include/footer.php");
?>