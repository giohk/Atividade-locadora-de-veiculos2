<?php
    namespace Models;
    use interfaces\Locavel;

    // classe que representa um carro
    class Carro extends Veiculo implements locavel {
        public function calcularAluguel(int $dias):float {
            return $dias;
        }
        public function alugar():string{
            if($this->disponivel){
                $this->disponivel = false;
                return "Helicóptero '{$this->modelo}' alugado com sucesso!"; 
            }
            return "Helicóptero '{$this->modelo} indisponível no momento, por favor escolha outro.'";
        }
        public function devolver():string{
            if(!$this->disponivel){ // exclamação é a lógica da negação
                $this->disponivel = true;
                return "Helicóptero '{$this->modelo}' devolvido com sucesso!"; 
            }
            return "Helicóptero '{$this->modelo} já disponível.'";
        }
    }
?>