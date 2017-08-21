<?php

namespace Admin;

use Admin\Controller\InvoiceController;
use Admin\Controller\LoginController;
use Admin\Controller\ProductGroupController;
use Admin\Controller\ProfileController;
use Admin\Controller\UserTableController;
use Zend\Db\Adapter\AdapterInterface;

use Admin\Controller\ProductTableController;

use Zend\Mvc\MvcEvent;

class Module {

    const VERSION = '3.0.3-dev';

    public function getConfig() {

        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {

        return array(
            'factories' => array(
                // gọi file kết nối cơ sở dữ liệu ra
                Model\BangKhachhang::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    return new Model\BangKhachhang($dbAdapter);
                }
            )
        );
    }



    public function onBootstrap(MvcEvent $event) {
        session_start();
        $eventManager = $event->getApplication()->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_ROUTE, function (MvcEvent $e) {
            $controllerName = $e->getRouteMatch()->getParam('controller', null);
            if (Controller\IndexController::class === $controllerName || ProductTableController::class === $controllerName
            || ProfileController::class === $controllerName ||
                UserTableController::class === $controllerName ||
                InvoiceController::class === $controllerName ||
                ProductGroupController::class === $controllerName
            ) {
                $auth = $e->getApplication()
                        ->getServiceManager()
                        ->get(Model\Authentication::class);
                if (false === $auth->hasIdentity()) {
                    $url = $e->getRouter()->assemble(array(), array('name' => 'admin/login'));
                    $response = $e->getResponse();
                    $response->getHeaders()->addHeaderLine('Location', $url);
                    $response->setStatusCode(302);
                    $response->sendHeaders();
                    return $response;
                }
                $e->getViewModel()->setTemplate('layout/admin');
            }
            if(LoginController::class === $controllerName)
            {
                $e->getViewModel()->setTemplate('layout/login');
            }
        }, -100);


    }

    function onDispatchError(MvcEvent $e) {
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/error');
    }

}
