<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\AddProductToCartRequest;
use App\Http\Requests\DashBoard\Product\GetProductRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {
    }

    // get cart details
    public function get_cart_details()
    {
        $user = auth()->user();

        $cart = $this->cartService->checkCartIfEmpty($user->id);

        if ($cart) {
            $this->cartService->updateCartPrices($cart->id);
            $success = $this->cartService->getCartDetails($cart->id);
            return $this->sendResponse('', $success);
        }
        else {
            $success['cart'] = (object) [];

            return $this->sendResponse('', $success);
        }
    }

    //add product to cart
    public function add_product_to_cart(AddProductToCartRequest $request)
    {
        $user = auth()->user();

        $success = $this->cartService->addProductToCart($user, $request->product_id, $request->quantity);
        return $this->sendResponse(__('messages.added_product_to_cart'), []);
    }

    //remove product from cart 
    public function remove_product_from_cart(GetProductRequest $request)
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
