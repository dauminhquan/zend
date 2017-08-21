<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 20/08/2017
 * Time: 12:46
 */

namespace Admin\Model;


use Zend\Db\TableGateway\TableGateway;

class ImageTable
{
    private $table;
    public function __construct(TableGateway $table)
    {
        $this->table = $table;
    }

    public function LaytheoId($id) {
        try
        {
            $dt= $this->table->select(array('id_sanpham' =>$id));
            $dt->current();
            $data = array();
            foreach ($dt as $row)
            {
                array_push($data,$row);
            }
            return $data;
        } catch (Exception $ex) {
            echo "Lỗi";
            return false;
        }

    }
    public function Anhdaidien($id_sanpham)
    {
        try
        {
            $select = $this->table->getSql()->select();
            $select->where(array('id_sanpham'=>$id_sanpham))->where(array('anhdaidien' => 1));
            $dt = $this->table->selectWith($select);
            return $dt->current();
        }catch (Exception $ex)
        {

        }
    }
    public function Laytoanbo() {
        return $this->table->select();
    }

    public function Luu(Image $image) {

        $data = $image->getarray();

        $id_image = (int) $image->id_image;
        if ($id_image == 0) {
            $this->table->insert($data);
        } else {
            if ($this->LaytheoId($id_image)) {
                $this->table->update($data, array('id_image' => $id_image));
            } else {
                throw new \Exception('Không thể update bảng');
            }
        }
    }

    public function Xoa($id) {
        $this->table->delete(array('id_image' => $id));

    }
    public function XoaSanpham($id_sanpham)
    {
        $check = $this->table->select(array('id_sanpham' => $id_sanpham));
        $data = $check->current();
        if(isset($data))
        {
            $this->table->delete(array('id_sanpham'=>$id_sanpham));
        }

    }
}