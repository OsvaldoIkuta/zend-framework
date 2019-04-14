<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:14
 */

namespace Application\Model;


class Assunto
{
    public $codigo;
    public $assunto;
    public $detalhes;

    public function __construct(array $data)
    {
        $this->codigo = $data['codigo'] ?? null;
        $this->assunto = $data['assunto'] ?? null;
        $this->detalhes = $data['detalhes'] ?? null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
