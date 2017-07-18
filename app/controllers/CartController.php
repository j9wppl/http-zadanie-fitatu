<?php namespace Fitatu\Controllers;

use BaseController;
use Fitatu\Models\TaxRepository;
use Fitatu\Services\CartService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CartController extends BaseController
{
    protected $layout = 'layout.main';

    /**
     * @var CartService
     */
    private $cartService;

    private $taxRepository;

    public function __construct(CartService $cartService, TaxRepository $taxRepository)
    {
        $this->cartService = $cartService;
        $this->taxRepository = $taxRepository;
    }

    public function index()
    {
        $taxes = $this->taxRepository->allAssoc();
        $cartItemsByTax = $this->cartService->getCartItemsByTax();
        $totalGross = $this->cartService->getCurrentCart()->cartItems->totalGross();

        $this->layout = View::make('cart', compact('taxes', 'cartItemsByTax', 'totalGross'));
    }

    public function add($id)
    {
        $this->cartService->addToCart($id);

        return Redirect::route('cart');
    }

    public function remove($id)
    {
        $this->cartService->removeFromCart($id);

        return Redirect::route('cart');
    }

    public function decrementItem($id)
    {
        $this->cartService->decrementItem($id);

        return Redirect::route('cart');
    }
}
