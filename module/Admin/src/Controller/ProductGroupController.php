<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 18/08/2017
 * Time: 20:02
 */

namespace Admin\Controller;


use Admin\Model\BangNhomsanpham;
use Admin\Model\Nhomsanpham;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductGroupController extends AbstractActionController
{
    private $bangnhomsanpham;
    private $data;
    public function __construct(BangNhomsanpham $bangnhomsanpham)
    {
        $this->bangnhomsanpham = $bangnhomsanpham;
    }
    public function indexAction()
    {
        $this->data = array();
        $result = $this->bangnhomsanpham->Laytoanbo();
        foreach ($result as $row)
        {
            $nhomsanpham = new Nhomsanpham();
            $nhomsanpham->Copydata($row);
            array_push($this->data,$nhomsanpham->getarray());
        }
        return new ViewModel(array(
            'data' => $this->data,
        ));
    }

}