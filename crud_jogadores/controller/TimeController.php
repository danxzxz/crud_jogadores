<?php

require_once(__DIR__ . "/../dao/TimeDAO.php");

class TimeController {

    private TimeDAO $timeDAO;

    public function __construct() {
        $this->timeDAO = new TimeDAO;
    }

    public function listar() {
        return $this->timeDAO->listar();
    }

    
}