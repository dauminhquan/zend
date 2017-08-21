<?php
namespace Admin\Controller;

use Admin\Factory\ImageTableFactory;
use Admin\Model\ImageTable;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Admin\Model\BangSanpham;
use Admin\Model\BangNhomsanpham;
use Admin\Model\BangLoaisanpham;
class ProductTableController extends AbstractActionController {
    private $bangsanpham;
    private $bangnhomsanpham;
    private $bangloaisanpham;
    private $imagetable;
    public $data;
    public function __construct(BangSanpham $bangsanpham,BangNhomsanpham $bangnhomsanpham, BangLoaisanpham $bangloaisanpham,ImageTable $imagetable) {
        $this->bangsanpham = $bangsanpham;
        $this->bangnhomsanpham = $bangnhomsanpham;
        $this->bangloaisanpham = $bangloaisanpham;
        $this->imagetable = $imagetable;
    }
    public function indexAction() {
        $this->data = array();
        $result = $this->bangsanpham->Laytoanbo();
        foreach ($result as $row)
        {
            $sp = new \Admin\Model\Sanpham();
            $sp->Copydata($row);
            $dt = $sp->getarray();

            //lay bang nhom san pham
            $nsp=$this->bangnhomsanpham->LaytheoId($row->id_nhomsanpham);
            //lay ten bang nhom sanpham
            $tenbangnhomsanpham = $nsp->tennhomsanpham;
            //lay id_loaisanpham
            $lsp = $this->bangloaisanpham->LaytheoId($nsp->id_loaisanpham);
            //lay ten loai san pham
            $tenloaisanpham = $lsp->tenloaisanpham;

            $dt['id_loaisanpham'] = $nsp->id_loaisanpham;
            //
            $dt['tenloaisanpham'] = $tenloaisanpham;
            //

            $dt['tennhomsanpham'] = $nsp->tennhomsanpham;
            $dt['thongtinnhomsanpham'] = $nsp->thongtinnhomsanpham;

            $image = $this->imagetable->Anhdaidien($row->id_sanpham);
            $dt['url'] = $image['url'];
            array_push($this->data,$dt);         
        }
        return new ViewModel(array(
            'data' => $this->data,
        ));
    }
    public function deleteAction()
    {
        if($this->getRequest()->isPost() == true)
        {
            if(isset($_POST['value']))
            {
                $data = $_POST['value'];

                for($i=0;$i<count($data);$i++)
                {
                    try{
                        $this->imagetable->XoaSanpham((int)$data[$i]);
                        $this->bangsanpham->Xoa((int)$data[$i]);
                    }catch (\Exception $ex)
                    {
                        return new JsonModel(array(
                            'result' => $ex->getMessage(),
                        ));
                    }
                }
                return new JsonModel(array(
                    'result' => true
                ));
            }
        }
        header('Local '.$this->redirect()->toRoute('admin/producttable',['action'=>'index']));

    }
    public function addAction()
    {

    }
}
