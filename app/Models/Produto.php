<?php

namespace App\Models; // Define onde o aquivo está localizado 

use Illuminate\Database\Eloquent\Model; // Importa a classe model do Laravel ORM

class Produto extends Model // A classe Produto herda tudo de Models (salvar() deletar() alterar() e entre outros)
{
    protected $table = 'produtos'; // Define qual tabela o banco vai usar

    protected $fillable = ['nome', 'descricao', 'preco', 'tipo', 'adicionais', 'image_path']; // Campos a serem preenchidos
}


