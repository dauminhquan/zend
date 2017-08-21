<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 20/08/2017
 * Time: 12:47
 */

namespace Admin\Model;
class Image
{
    public $id_image,$url,$id_sanpham,$anhdaidien;
    public function Copydata($data) {
        $this->id_image = (!empty($data['$id_image'])) ? $data['$id_image'] : null;
        $this->url = (!empty($data['url'])) ? $data['url'] : null;
        $this->id_sanpham = (!empty($data['id_sanpham'])) ? $data['id_sanpham'] : null;
        $this->anhdaidien = (!empty($data['anhdaidien'])) ? $data['anhdaidien'] : null;

    }

    public function getarray() {
        return array(
            'id_image' => $this->id_image,
            'url' => $this->url,
            'id_sanpham' => $this->id_sanpham,
            'anhdaidien' => $this->anhdaidien,

        );
    }

}