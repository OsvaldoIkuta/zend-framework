<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\Assunto;
use Application\Model\Demanda;
use Application\Model\Solicitante;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;

class IndexController extends AbstractActionController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function processarAction()
    {
        $solicitante = new Solicitante($_POST);

        $assunto = new Assunto($_POST);
        $detalhes = ($_POST['detalhes'] ?? null);

        $_SESSION['dados'] = [
            'soliciante' => $solicitante,
            'assunto' => $assunto,
            'detalhes' => $detalhes
        ];


        if (empty($solicitante->cpf) || empty($assunto) || empty($detalhes)) {
            $_SESSION['mensagem'] = 'Preencha os campos!';
            return $this->redirect()->toRoute('application');
        }

        $solicianteTable = $this->container->get('SolicitanteTable');
        $solicianteTable->persist($solicitante);

        $assuntoTable = $this->container->get('AssuntoTable');
        $result = $assuntoTable->getByAssunto($assunto->assunto);
        if ($result->count() > 0 ){
            $_SESSION['dados']['detalhes_gravados'] = $result->current()['detalhes'];
            return $this->redirect()->toRoute('application');
        }else {
            $assuntoTable->persist($assunto);
            $codigoAssunto = $assuntoTable->getMaxCodigo();
            //var_dump($codigoAssunto);exit;
        }

        $demanda = new Demanda($solicitante->cpf, $codigoAssunto);
        $demandaTable = $this->container->get('DemandaTable');
        $demandaTable->persist($demanda);

        $_SESSION['dados'] = [];

        return new ViewModel();
    }
}
