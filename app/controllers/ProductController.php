<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->get_all();
        $data['page_title'] = 'Products – Kyle Daniel Belano';
        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Add Product – Kyle Daniel Belano';
        $this->call->view('products/create', $data);
    }

    public function store()
    {
        $data = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'price'        => floatval($_POST['price'] ?? 0),
            'quantity'     => intval($_POST['quantity'] ?? 0),
        ];

        $this->ProductModel->insert_product($data);
        redirect('products');
    }

    public function edit($id)
    {
        $product = $this->ProductModel->get_by_id($id);

        if (!$product) {
            redirect('products');
        }

        $data['product'] = $product;
        $data['page_title'] = 'Edit Product – Kyle Daniel Belano';
        $this->call->view('products/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description'  => trim($_POST['description'] ?? ''),
            'price'        => floatval($_POST['price'] ?? 0),
            'quantity'     => intval($_POST['quantity'] ?? 0),
        ];

        $this->ProductModel->update_product($id, $data);
        redirect('products');
    }

    public function delete($id)
    {
        $this->ProductModel->delete_product($id);
        redirect('products');
    }
}
