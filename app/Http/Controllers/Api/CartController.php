<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\Product\GetProductRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService ;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService ;
    }

    public function getCartDetails()
    {
        $user = auth()->user();

        $cart = $this->cartService->checkCartIfEmpty($user->id);

        if ($cart) {
            $this->cartService->updateCartPrices($cart->id);
            $success = $this->cartService->getCartDetails($cart->id);

            return $this->sendResponse('', $success);
        } else {
            $success['cart'] = (object) [];

            return $this->sendResponse('', $success);
        }
    }

    public function addProductToCart(AddProductToCartRequest $request)
    {
        $user = auth()->user();

        $success = $this->cartService->addProductToCart($user, $request->product_id, $request->quantity);
        return $this->sendResponse(__('messages.added_product_to_cart'), []);
    }

    public function removeProductFromCart(GetProductRequest $request)
    {
        $user = auth()->user();

        $cart = $this->cartService->checkCartIfEmpty($user->id);

        if (!$cart) {
            return $this->sendError(__('messages.cart_is_empty'), 400);
        } else {
            $success = $this->cartService->removeProductFromCart($cart, $request->product_id);

            if (!$success) {
                return $this->sendError(__('messages.product_not_found'), 400);
            }

            return $this->sendResponse(__('messages.removed_product_from_cart'), []);
        }
    }
}
