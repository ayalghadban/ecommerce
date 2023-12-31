<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

/**
 * Class CartService
 * @package App\Services
 */
class CartService
{
    public static function updateCartPrices($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->first();

        $overall_total = 0;
        $cart_items_count = 0;

        $cart_items = $cart->cartItems()->get();

        foreach ($cart_items as $cart_item) {

            $product = Product::where('id', $cart_item->product_id)->first();
            $product_price = $product->product_price;
            $overall_total += $product_price * $cart_item->quantity;
            $cart_items_count++;
        }

        $cart->overall_total = $overall_total;
        $cart->cart_items_count = $cart_items_count;
        $cart->save();

        return $cart;
    }

    public static function checkCartIfEmpty($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if (isset($cart) && $cart->cart_items_count > 0) {
            return $cart;
        } else {
            return false;
        }
    }

    public static function getCartDetails($cart_id)
    {
        $data = [];

        $cart = Cart::where('id', $cart_id)->select(['id', 'sub_total', 'delivery_fees', 'overall_total', 'cart_items_count'])->first();
        $cart_items = $cart->cartItems()->with('product', 'product.productTranslations')->get();

        $data['cart'] = $cart;
        $data['cart']->cart_items = $cart_items;

        return $data;
    }

    public static function addProductToCart($user, $product_id, $quantity)
    {
        $cart = $user->cart()->first();

        if (isset($cart)) {
            $cart_product = CartItem::where([['cart_id', $cart->id], ['product_id', $product_id]])->first();

            if (isset($cart_product)) {
                $cart_product->quantity = $quantity;
                $cart_product->save();
            } else {
                $cart->cartItems()->create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
            }
            $cart->cart_items_count += 1;
            $cart->save();
        } else {

            $cart = $user->cart()->create([
                'overall_total' => 0,
                'cart_items_count' => 1,
            ]);

            $cart->cartItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        CartService::updateCartPrices($cart->id);

        return [];
    }

    public static function removeProductFromCart($cart, $product_id)
    {
        if (isset($cart)) {

            //Check if item is in already in cart
            $cart_product = CartItem::where([['cart_id', $cart->id], ['product_id', $product_id]])->first();

            if (!isset($cart_product)) {
                return false;
            } else {
                $cart_product->delete();
                $cart = CartService::updateCartPrices($cart->id);

                $cart_items_count = $cart->cart_items_count;

                if ($cart_items_count == 0) {
                    $cart->delete();
                }

                return true;
            }
        } else {
            return false;
        }
    }

    public static function checkCartProductsQuantities($cart)
    {
        $cart_items = $cart->cartItems()->get();
        foreach ($cart_items as $cart_item) {
            $product = Product::where('id', $cart_item->product_id)->first();
            if ($cart_item->quantity > $product->product_quantity) {
                return false;
            }
        }
        return true;
    }

    public static function getCartTotalsForOrder($cart_id)
    {
        $data = (object) [];

        if (!isset($cart_id)) {
            return false;
        }

        $cart = Cart::where('id', $cart_id)->first();
        $data->overall_total = $cart->overall_total;

        return $data;
    }

    public static function getCartProductsForOrder($cart_id)
    {
        $data['products'] = [];

        $cart = Cart::where('id', $cart_id)->first();

        $cart_items = $cart->cartItems()->get();

        foreach ($cart_items as $cart_item) {
            $product = Product::where('products.id', $cart_item->product_id)->with('productTranslations')
            ->select(['id', 'product_price', 'product_main_image'])
            ->first();

            $product->product_quantity = $cart_item->quantity;

            array_push($data['products'], $product);
        }

        return $data;
    }

    public static function emptyUserCart($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        $cart->delete();
    }
}
