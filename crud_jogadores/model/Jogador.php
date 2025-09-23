<?php

require_once(__DIR__ . "/Time.php");

class Jogador {

    private ?int $id;
    private ?string $nome;
    private ?int $idade;
    private ?string $estrangeiro;

    private ?Time $time;
    private ?Posicao $posicao;


        public function __construct() {
        $this->posicao = null;
        $this->time = null;
    }

    public function getPosicao(): ?Posicao
    {
        return $this->posicao;
    }

    public function setPosicao(?Posicao $posicao): self
    {
        $this->posicao = $posicao;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(?int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getEstrangeiro(): ?string
    {
        return $this->estrangeiro;
    }

    public function getEstrangeiroTexto(): string {
        if($this->estrangeiro == 'S')
            return "Sim";
        
        if($this->estrangeiro == 'N')
            return "Não";

        return "";
    }

    public function setEstrangeiro(?string $estrangeiro): self
    {
        $this->estrangeiro = $estrangeiro;

        return $this;
    }

    public function getTime(): ?Time
    {
        return $this->time;
    }

    public function setTime(?Time $time): self
    {
        $this->time = $time;

        return $this;
    }

}
    