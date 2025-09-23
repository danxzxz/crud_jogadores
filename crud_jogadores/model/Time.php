<?php

class Time {

    private ?int $id;
    private ?string $nome;
    private ?string $estado;

    public function __toString() {
        return $this->nome . ' (' . 
            $this->getEstadoTexto() . ")";
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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

     public function getEstadoTexto(): string
    {
        if($this->estado == "M")
            return "Matutino";

        if($this->estado == "V")
            return "Vespertino";

        if($this->estado == "N")
            return "Noestado";

        return "";
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}