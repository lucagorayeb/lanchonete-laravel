<?php
namespace App\Modules\Produto;

use App\Models\Produto;

class ProdutoService{

    /**
     * Cria e salva o registro do Produto na base de dados com as informações fornecidas.
     */
    public function adicionarProduto(string $nome, float $preco, ?string $descricao = null, ?string $tipo = null, ?string $adicionais = null, ?string $image_path = null) : Produto{
        $produto = Produto::create([
            'nome' => $nome, 
            'descricao' => $descricao,
            'preco' => $preco,
            'tipo' => $tipo,
            'adicionais' => $adicionais,
            'image_path' => $image_path // Caminho gerado pelo upload no MinIO/S3
        ]);
        return $produto;
    }

    public function deletarProduto(Produto $produto) : void{
        $produto->delete();
    }
    
    public function alterarProduto(Produto $produto, array $dados) : ?Produto{
        if ($produto === null) {
            return null;
        }
        
        $produto->update($dados);
        return $produto;
    }

    public function listarProduto(){
        return Produto::all();
    }
}
