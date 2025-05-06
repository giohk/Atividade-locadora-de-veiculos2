<?php
namespace Models;
use Interfaces\Locavel;


// Classe que representa uma moto


class Moto extends Veiculo implements Locavel {
 
    public function calcularAluguel(int $dias): float
    {
        return $dias * DIARIA_MOTO;
    }

    public function alugar() : string
    {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Moto '{$this->modelo}' alugado com sucesso!";
        }
        return "Moto '{$this->modelo}' já está alugado";
    }

    public function devolver(): string
    {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Moto '{$this->modelo}' devolvido com sucesso!";
        }
        return "Moto '{$this->modelo}' disponínel para aluguel";
    }
}


?>