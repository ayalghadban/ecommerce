<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\GetOrderRequest;
use App\Http\Requests\Order\GetUserOrdersRequest;
use App\Http\Requests\Order\UserCheckoutRequest;
use App\Http\Requests\Payment\AddPaymentRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;
    private CartService $cartService;
    private ProductService $productService;
    private UserService $userService;

    public function __construct(OrderService $orderService, CartService $cartService, ProductService $productService,UserService $userService) {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->userService = $userService;
    }

    public function userCheckout(UserCheckoutRequest $request)
    {
        $user = auth()->user();
        $cart = $this->cartService->checkCartIfEmpty($user->id);
        if (!$cart) {
            return $this->sendError(__('messages.cart_is_empty'));
        }

        $cart_products_quantities_available = $this->cartService->checkCartProductsQuantities($cart);
        if (!$cart_products_quantities_available) {
            return $this->sendError(__('messages.cart_products_quantities_are_not_in_storage'));
        }

        $cart_products = $this->cartService->getCartProductsForOrder($cart->id);
        $totals = $this->cartService->getCartTotalsForOrder($cart->id);

        $address_request = $request->only('zone_number','lat','long','building_number','street');

        $order = OrderService::createOrder($user->id, $totals->overall_total, $cart_products, $totals);

        if($order) {
            $this->userService->updateUserAddressByUser($user->id,$address_request, $order->id);
        }

        $this->cartService->emptyUserCart($user->id);

        return $this->sendResponse(__('messages.order_submitted'), []);
    }

    public function getUserOrders(GetUserOrdersRequest $request)
    {
        $user = auth()->user();
        $success = $this->orderService->getUserOrders($user->id, $request->per_page);

        return $this->sendResponse('', $success);
    }

    public function getOrderTrackDetails(GetOrderRequest $request)
    {
        $user = auth()->user();

        $result = OrderService::checkIfUserDidOrder($user->id, $request->order_id);

        if (!$result) {
            return $this->sendError(__('messages.order_not_found'), 400);
        }

        $success = $this->orderService->getOrderTrackDetails($request->order_id);
        return $this->sendResponse('', $success);
    }

    public function cancelOrder(GetOrderRequest $request)
    {
        $order_status_is_delivered = $this->orderService->check_order_status($request->order_id, 'delivered');
        if (!$order_status_is_delivered) {
            $success = $this->orderService->cancel_order($request->order_id);

            return $this->sendResponse(__('messages.change_order_status_successfully'), $success);
        } else {
            return $this->sendError(__('messages.order_cannot_cancel'), 400);
        }
    }
}
