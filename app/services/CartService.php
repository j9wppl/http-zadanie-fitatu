<?php namespace Fitatu\Services;


use Fitatu\Models\Cart;
use Fitatu\Models\CartItem;
use Fitatu\Models\CartItemRepository;
use Fitatu\Models\CartRepository;
use Illuminate\Support\Facades\Session;


class CartService
{
    const CURRENT_CART_KEY = 'CURRENT_CART';

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var CartItemRepository
     */
    private $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function getCurrentCart()
    {
        $cart = Session::get(self::CURRENT_CART_KEY);
        if (!($cart instanceof Cart)) {
            $cart = $this->cartRepository->first();
            if (!($cart instanceof Cart)) {
                $cart = $this->cartRepository->newInstance();
                $cart->save();
            }
            Session::put(self::CURRENT_CART_KEY, $cart);
        }

        return $cart;
    }

    public function addToCart($productId)
    {
        $cart = $this->getCurrentCart();
        $cartItem = $this->cartItemRepository->findByCartIdAndProductId($cart->id, $productId);
        if ($cartItem instanceof CartItem) {
            $cartItem->quantity++;
        } else {
            $cartItem = $this->cartItemRepository->newInstance();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $productId;
            $cartItem->quantity = 1;
        }
        $cartItem->save();

        $this->reloadCurrentCart();
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = $this->cartItemRepository->find($cartItemId);

        if ($cartItem instanceof CartItem) {
            $cartItem->delete();
            $this->reloadCurrentCart();
        }
    }

    private function reloadCurrentCart()
    {
        $cart = $this->getCurrentCart();
        $cart->load('cartItems');
        Session::put(self::CURRENT_CART_KEY, $cart);
    }
}