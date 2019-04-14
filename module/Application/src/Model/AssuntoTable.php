<?php
/**
 * Created by PhpStorm.
 * User: osvaldoikuta
 * Date: 2019-04-13
 * Time: 13:32
 */

namespace Application\Model;


use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGatewayInterface;

class AssuntoTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function persist(Assunto $assunto)
    {
        $set = $assunto->toArray();
        $result = $this->tableGateway->select(['assunto' => $set['assunto']]);
        if ($result->count() == 0){
            $this->tableGateway->insert($set);
        }

    }


    public function getByAssunto($assunto)
    {
        return $this->tableGateway->select(['assunto' => $assunto]);
    }


    public function getMaxCodigo()
    {
        $expression = new Expression('max(codigo)');

        $select = new Select('assunto');
        $select->columns(['codigoAssunto' => $expression]);

        return $this->tableGateway->selectWith($select)->current()['codigoAssunto'];
    }


}
