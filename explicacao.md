# Funcionamento do Sistema de Locadora de Veículos com PHP e BOOTSTRAP
Este documento descreve o funcionameto do Sistema de Locadora de Veículos desenvolvido em PHP, utilizando o Bootstrap para interface, com autenticação de usuários, gerenciamento de veículos (carros e motos) e persistência de dados em arquivos JSON. O foco principal é explicar o funcionamento geral do sistema, com ênfase especial nos perfis de acesso (admin e usuário).

## 1. Visâo Geral do Sistema
O Sistema de Locadora de Veículos é uma aplicação Web que permite:

Autenticação de usuário com dois perfis: Admin (Administrador) e Usuário;
Cadastro de veículos: cadastro, aluguel e exclusão;
Cálculo de previsão de aluguel: com base no tipo de veículo (carro ou moto) e número de dias;
Interface responsiva.
Os dados são armazenados em dois arquivos JSON:

usuario.json: username, senha criptografada e perfil;
veiculos.json:Tipo do veículo, modelo, placa e status de disbonibilidade.

## 2. Estrutura do sistema
O sistema utiliza:

PHP: Para a lógica;
Bootstrap: Para estilização;
Bootstrap Icons: Para os ícones da interface;
Composer: Para autoloading de classes;
JSON: Para persistência de dados;

2.1 Componentes principais
Interfaces: Define a interface Locavel para veículos e utiliza os métodos alugar(), devolver() e isDisponivel()

Models: classes Veiculo (abstrata), Carro e Moto para os veículos, com cálculo de aluguel baseado em diárias constantes (DIARIA_CARRO e DIARIA_MOTO)

Services: Classes AUTH (autenticação e gerenciamento de usuários) e ´Locadora´ (gerenciamento dos veículos)