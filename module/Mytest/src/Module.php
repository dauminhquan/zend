<?php

namespace Mytest;
use Zend\Mvc\MvcEvent;

class Module {

    const VERSION = '3.0.3-dev';

    public function getConfig() {

        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // Register a dispatch event
        $app = $e->getParam('application');
        $app->getEventManager()->attach('dispatch', [$this, 'setLayout']);
    }

    /**
     * @param  MvcEvent $e The MvcEvent instance
     * @return void
     */
    public function setLayout(MvcEvent $e)
    {
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (false === strpos($controller, __NAMESPACE__)) {
            // not a controller from this module
            return;
        }
        // Set the layout template
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/test');
    }

}
