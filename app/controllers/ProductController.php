<?php namespace Fitatu\Controllers;

use BaseController;
use Fitatu\Models\ProductRepository;
use Illuminate\Support\Facades\View;

class ProductController extends BaseController
{
    protected $layout = 'layout.main';

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        $this->layout = View::make('products', compact('products'));
    }
}
