<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:32
 */

namespace Application\Model;


use Zend\Db\TableGateway\TableGatewayInterface;

class SolicitanteTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function persist(Solicitante $solicitante)
    {
        $set = $solicitante->toArray();
        $result = $this->tableGateway->select(['cpf' => $set['cpf']]);
        if ($result->count() == 0){
            $this->tableGateway->insert($set);
        }

    }


}
