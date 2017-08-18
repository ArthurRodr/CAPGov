<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
     protected $fillable = ['nome','matricula','cpf','enderecos_id'];
}
