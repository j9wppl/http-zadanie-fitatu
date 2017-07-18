<?php namespace Fitatu\Controllers;

use BaseController;
use Fitatu\Models\CartRepository;
use Fitatu\Services\CartService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CartController extends BaseController
{
    protected $layout = 'layout.main';

    public function index()
    {
        $cart = app(CartService::class)->getCurrentCart();
        $cartItems = $cart->cartItems;
        $this->layout = View::make('cart', compact('cartItems'));
    }

    public function add($id)
    {
        app(CartService::class)->addToCart($id);

        return Redirect::route('cart');

    }

    public function remove($id)
    {
        app(CartService::class)->removeFromCart($id);

        return Redirect::route('cart');
    }

}
