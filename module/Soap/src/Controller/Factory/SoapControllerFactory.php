<?php
/**
 * Created by IntelliJ IDEA.
 * User: mukeshyadav
 * Date: 3/7/17
 * Time: 3:02 PM
 */

namespace Soap\Controller\Factory;
use Soap\Model\Env;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Soap\Controller\SoapController;

class SoapControllerFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container,$requestedName,array $options = null)
    {
        $env = $container->get(Env::class);

        return new SoapController($env);
    }
}
