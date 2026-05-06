<?php
namespace App\Modules\Cliente;
use App\Models\User;

class UserService{

    public function adcionarUser(string $nome, string $email, string $cpf, string $numero, string $senha) : User{
      
    $cliente = User::create(
            [
                'nome' => $nome, 
                'email' => $email, 
                'cpf' => $cpf,
                'numero' => $numero,
                'senha' => $senha
            ]);
        return $cliente;
    }

    public function deletarUser(User $cliente) : void{
        $cliente->delete();
    }

    public function alterarUser(array $data, User $cliente) : ?User{
        if($cliente === null){
            return null;   
        }
        
        $cliente->update($data);
        return $cliente;
    }
}