<?php
namespace Services;
// autentificação
// define espaço para organizaçâo do codigo

// declarar classes
// class principal

class Auth{
    // esta privado pq nao e pra ter em nenhum lugar a mais
    private array $usuarios = [];

    // Método construtor /  ele chama de forma automatica para chamar os usuarios 
    public function __construct(){
        $this ->carregarUsuarios();
    }

    // carregar usuarios/variavel
    // Método para carregar usuarios do arquivo JSON
    private function carregarUsuarios(): void {
        
        // verificar se existe o arquivo 
        if (file_exists(ARQUIVO_USUARIOS)) {
            // le o conteudo e decodifica o json para o array que um vetor
            $conteudo = json_decode(file_get_contents(ARQUIVO_USUARIOS), true);
            // file_get_contents =pega o arquivo usuario

            // vereficar se é um array
            $this->usuarios = is_array($conteudo) ? $conteudo : [];

        } else {
            // se ele nao existir ele força a existir
            $this-> usuarios = [
               [   
                    'username' => 'admin',
                    'password' => password_hash('admin123', PASSWORD_DEFAULT),
                    'perfil' => 'admin'
               ],
               [ 
                    'username' => 'usuario',
                    'password' => password_hash('usuario123',PASSWORD_DEFAULT),
                    'perfil' => 'usuario'
               ]
            ];
            $this ->salvarUsuarios();
        }
    }
    // funçao para salvar usuarios no arquivo JSON
    private function salvarUsuarios():void {
        $dir = dirname(ARQUIVO_USUARIOS);

        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
            // esse mkdir da autorização total para editar
        }

        file_put_contents(ARQUIVO_USUARIOS, json_encode($this->usuarios, JSON_PRETTY_PRINT));
    }

    // Metodo para realizar login
    public function login(string $username, string $password): bool{

        foreach ($this -> usuarios as $usuario){
            if ($usuario['username'] === $username && password_verify ($password, $usuario['password'])){
                // inicia seçao
                $_SESSION['auth'] = [
                    'logado' => true,
                    'username' => $username,
                    'perfil' => $usuario['perfil']
                ];
                return true; // login realizado
            }
        }
        // se o login nao realizar:
        return false; // nao foi realizado o login
    }

    // logout
    public function logout() : void{ //retorna vazio
        session_destroy();
    }

    // funçao para verficar se o usuario está logado
    public static function verificarLogin():bool{
        return isset($_SESSION['auth']) && $_SESSION ['auth']['perfil'] === true;
    }
    // funçao para se tem perfil especifico
    public static function isPerfil(string $perfil): bool{
        return isset($_SESSION['auth']) && $_SESSION ['auth']['perfil'] === $perfil;
    }
    // funçao para ver se e administrador
    public static function isAdmin():bool {
        return self::isPerfil('admin');
    }
    // funçao para pegar dados do usuario

    public static function getUsuarios(): ?array {
        // retorna os dados da sessão ou nulo se não existir
        return $_SESSION['auth'] ?? null;
    }
}