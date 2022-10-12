<?php

namespace App\Controllers;

use App\Models\ProductModel;
use System\Core\Controller;
use System\Core\Session;

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel;       
    }

    public function store()
    {
        $this->isMethod('POST');

        $data = [
            'name'         => $this->input('name'),
            'category_id'  => $this->input('categoryId'),
            'thumb'        => $this->input('thumb'),
        ];

        if (empty($data['name']))
            return json(['error' => true, 'message' => 'Vui lòng nhập tên sản phẩm!', 'input' => 'name']);

        if(empty($data['thumb']))
            return json(['error' => true, 'message' => 'Vui lòng thêm ảnh cho sản phẩm!', 'input' => 'thumb']);

        $result = $this->productModel->insert($data);

        if (!$result) {
            Session::set('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            return json();
        }

        Session::set('success', 'Thêm sản phẩm thành công');
        return json();
    }

    public function copy()
    {
        $this->isMethod('POST');

        $data = [
            'name'         => $this->input('name') . ' copy',
            'category_id'  => $this->input('categoryId'),
            'thumb'        => $this->input('thumb'),
        ];

        if (empty($data['name']) || empty($data['thumb']) || empty($data['category_id'])){
            Session::set('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            return json();
        }

        $result = $this->productModel->insert($data);

        if (!$result) {
            Session::set('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            return json();
        }

        Session::set('success', 'Sao chép thành công sản phẩm ' . $this->input('name'));
        return json();
    }

    public function remove()
    {
        $this->isMethod('POST');

        $id = $this->input('id');

        $result = $this->productModel->show($id);
        if (!$result) {
            Session::set('error', 'Sản phẩm không tồn tại!');
            return json();
        }

        $delete = $this->productModel->delete($id);

        if(!$delete){
            Session::set('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            return json();
        }

        Session::set('success', 'Xóa thành công sản phẩm #' . $id);
        return json();
    }

    public function update($id = '')
    {
        $this->isMethod('POST');

        $data = [
            'name'         => $this->input('name'),
            'category_id'  => $this->input('categoryId'),
            'thumb'        => $this->input('thumb'),
        ];

        if (empty($data['name']))
            return json(['error' => true, 'message' => 'Vui lòng nhập tên sản phẩm!', 'input' => 'name']);

        if(empty($data['thumb']))
            return json(['error' => true, 'message' => 'Vui lòng thêm ảnh cho sản phẩm!', 'input' => 'thumb']);


        $result = $this->productModel->update($data, $id);

        if (!$result) {
            Session::set('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            return json();
        }

        Session::set('success', 'Cập nhật thành công sản phẩm #' . $id);
        return json();
    }
}

