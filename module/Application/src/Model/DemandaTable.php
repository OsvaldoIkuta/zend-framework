<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:32
 */

namespace Application\Model;


use Zend\Db\TableGateway\TableGatewayInterface;

class DemandaTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function persist(Demanda $demanda)
    {
        $set = $demanda->toArray();
        $this->tableGateway->insert($set);


    }


}
