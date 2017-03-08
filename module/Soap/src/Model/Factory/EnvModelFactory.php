<?php
/**
 * Created by IntelliJ IDEA.
 * User: mukeshyadav
 * Date: 3/7/17
 * Time: 3:02 PM
 */

namespace Soap\Model\Factory;
use Soap\Model\Env;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EnvModelFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container,$requestedName,array $options = null)
    {
        return new Env();
    }
}
