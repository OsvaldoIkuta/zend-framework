<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:14
 */

namespace Application\Model;


class Solicitante
{
    public $cpf;
    public $nome;
    public $cep;
    public $municipio;
    public $uf;
    public $email;
    public $ddd;
    public $telefone;

    public function  __construct(array $data)
    {
        $this->cpf = $data['cpf'] ?? null;
        $this->nome = $data['nome'] ?? null;
        $this->cep = $data['cep'] ?? null;
        $this->municipio = $data['municipio'] ?? null;
        $this->uf = $data['uf'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->ddd = $data['ddd'] ?? null;
        $this->telefone = $data['telefone'] ?? null;
        /*foreach ($data as $key => $value){
            if (isset($this->$key)){
                $this->$key = $value;
            }

        }*/
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}
