<?php namespace Fitatu\Controllers;

use BaseController;
use Fitatu\Models\Product;
use Illuminate\Support\Facades\View;


class ProductController extends BaseController
{
    protected $layout = 'layout.main';

    public function index()
    {
        $products = app(Product::class)->all();
        $this->layout = View::make('products', compact('products'));
    }
}
