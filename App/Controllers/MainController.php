<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use System\Core\Controller;

class MainController extends Controller
{
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel; 
        $this->productModel = new ProductModel;     
    }
    public function index()
    {
        $search = null;
        $limit  = 3;
        $page   = 1;

        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }

        if(isset($_GET['pages']) && (int) $_GET['pages'] >= 2){
            $page = (int) $_GET['pages'];
        }

        #đếm tổng rows
        $numRows = $this->productModel->getCountAll($search);
        $numRows = $numRows->num_rows;
        $sumPage = ceil($numRows / $limit);

        $offset = ($page - 1) * $limit;

        return $this->view('index', [
            'title' => 'Bài Test Lampart',
            'menus' => $this->categoryModel->get(),
            'products' => $this->productModel->get($limit, $offset, $search),
            'sumPage' => $sumPage,
            'page' => $page,
            'count' => $numRows
        ]);
    }
}