<?php
namespace Mytest\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class IndexController extends AbstractActionController {

    public function indexAction() {
        $view = new ViewModel([
            'message' => 'Hello world',
        ]);

        // Capture to the layout view's "article" variable
        $view->setCaptureTo('article');
        return $view;
    }
}
