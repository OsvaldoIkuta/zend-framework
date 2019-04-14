<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:14
 */

namespace Application\Model;


class Demanda
{
    /**
     * @var integer
     */
    public $codigo;
    /**
     * @var Solicitante
     */
    public $codigo_solicitante;

    /**
     * @var Assunto
     */
    public $codigo_assunto;

    public function __construct($solicitante, $assunto)
    {
        $this->codigo = $data['codigo'] ?? null;
        $this->codigo_solicitante = $solicitante ?? null;
        $this->codigo_assunto = $assunto ?? null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
