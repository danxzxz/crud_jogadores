<?php

require_once(__DIR__ . "/../model/Jogador.php");

class JogadorService{

    public function validarJogador(Jogador $jogador){

            $erros = [];    

            if(! $jogador->getNome()){
                array_push($erros, "informe o nome do jogador");
            }
            if(! $jogador->getIdade()){
                array_push($erros, "informe a idade do jogador");
            }
            if(! $jogador->getEstrangeiro()){
                array_push($erros, "informe se o jogador é estrangeiro");
            }

            if(! $jogador->getTime()->getId()){
                array_push($erros, "informe o time do jogador");
            } 


            return $erros;

    }
}
