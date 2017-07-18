<?php namespace Fitatu\Services;

use Fitatu\Models\Cart;
use Fitatu\Models\CartItem;
use Fitatu\Models\CartItemCollection;
use Fitatu\Models\CartItemRepository;
use Fitatu\Models\CartRepository;
use Fitatu\Models\Product;
use Fitatu\Models\ProductRepository;
use Fitatu\Models\TaxRepository;
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

    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * CartService constructor.
     * @param CartRepository $cartRepository
     * @param CartItemRepository $cartItemRepository
     * @param TaxRepository $taxRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        TaxRepository $taxRepository,
        ProductRepository $productRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->taxRepository = $taxRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return Cart
     */
    public function getCurrentCart()
    {
        $cart = Session::get(self::CURRENT_CART_KEY);
        //$cart = null;
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

    /**
     * @param $productId
     */
    public function addToCart($productId)
    {
        $product = $this->productRepository->find($productId);
        if (!($product instanceof Product)) {
            return;
        }

        $cart = $this->getCurrentCart();
        $cartItem = $this->cartItemRepository->findByCartIdAndProductId($cart->id, $productId);
        if ($cartItem instanceof CartItem) {
            $cartItem->quantity++;
        } else {
            $cartItem = $this->cartItemRepository->newInstance();
            $cartItem->cart_id = $cart->id;
            $cartItem->price_net = $product->price_net;
            $cartItem->price_gross = $product->price_gross;
            $cartItem->product_id = $productId;
            $cartItem->quantity = 1;
        }
        $cartItem->save();

        $this->reloadCurrentCart();
    }

    /**
     * @param $cartItemId
     */
    public function decrementItem($cartItemId)
    {
        $cartItem = $this->cartItemRepository->find($cartItemId);
        if (!($cartItem instanceof CartItem)) {
            return;
        }

        if (1 == $cartItem->quantity) {
            return $this->removeFromCart($cartItemId);
        }

        $cartItem->quantity--;
        $cartItem->save();

        $this->reloadCurrentCart();
    }


    /**
     * @param $cartItemId
     */
    public function removeFromCart($cartItemId)
    {
        $cartItem = $this->cartItemRepository->find($cartItemId);
        if (!($cartItem instanceof CartItem)) {
            return;
        }

        $cartItem->delete();
        $this->reloadCurrentCart();
    }

    /**
     * @return arrays
     */
    public function getCartItemsByTax()
    {
        $result = [];
        $cartItemsWithTax = [];

        $cart = $this->getCurrentCart();
        $cartItems = $cart->cartItems()->with('product')->get();
        foreach ($cartItems as $cartItem) {
            $cartItemsWithTax[$cartItem->product->tax_id][] = $cartItem;
        }
        foreach ($cartItemsWithTax as $taxId => $cartItems) {
            $result[$taxId] = CartItemCollection::make($cartItems);
        }

        return $result;
    }

    private function reloadCurrentCart()
    {
        $cart = $this->getCurrentCart();
        $cart->load('cartItems');
        Session::put(self::CURRENT_CART_KEY, $cart);
    }
}