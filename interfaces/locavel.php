<?php

namespace interfaces;

// interface que defineos metodos necessario para o veiculo ser locável
interface Locavel{
    public function alugar() : string;
    public function devolver() : string;
    public function isDisponivel() : bool;
}

?>