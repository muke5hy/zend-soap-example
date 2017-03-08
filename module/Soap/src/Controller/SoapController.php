<?php
namespace Soap\Controller;

use Soap\Model;
use Zend\Soap\AutoDiscover as WsdlAutoDiscover;
use Zend\Soap\Server as SoapServer;
use Zend\Mvc\Controller\AbstractActionController;

class SoapController extends AbstractActionController{

    private $env;

    public function __construct(Model\Env $env){
        $this->env = $env;
    }

    public function wsdlAction(){
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();

        if (!$request->isGet()) {
            return $this->prepareClientErrorResponse('GET');
        }

        $wsdl = new WsdlAutoDiscover();
//        $this->populateServer($wsdl);
//        print_r($this->url($this->route));
        $wsdl->setUri($this->url($this->route))
            ->setServiceName('serverAction');

        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();

        $response->getHeaders()->addHeaderLine('Content-Type', 'application/wsdl+xml');
        $response->setContent($wsdl->toXml());
        return $response;
    }

    private function prepareClientErrorResponse($allowed){
        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();
        $response->setStatusCode(405);
        $response->getHeaders()->addHeaderLine('Allow', $allowed);
        return $response;
    }

    private function populateServer($server){
        // Expose a class and its methods:
        $server->setClass(Model\Products::class);

        // Expose an object instance and its methods:
        $server->setObject($this->env);

        // Expose a function:
        $server->addFunction('Soap\Model\ping');
    }

    public function serverAction(){
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->prepareClientErrorResponse('POST');
        }

        // Create the server
        $server = new SoapServer(
            $this->url()
                ->fromRoute('soap/wsdl', [], ['force_canonical' => true]),
            [
                'actor' => $this->url()
                    ->fromRoute('soap/server', [], ['force_canonical' => true]),
            ]
        );
        $server->setReturnResponse(true);
        $this->populateServer($server);

        $soapResponse = $server->handle($request->getContent());

        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();

        // Set the headers and content
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/soap+xml');
        $response->setContent($soapResponse);
        return $response;
    }
}
