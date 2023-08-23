<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashBoard\User\GetUserRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Ramsey\Uuid\Type\Integer;

class OrderController extends Controller
{


    public function __construct(private OrderService $orderService,
    private CartService $cartService,
    private ProductService $productService,
    private UserService $userService) {

    }

    //get all order for one user
    public function get_user_orders()
    {
        $user = auth()->user();
        $success = $this->orderService->get_user_orders($user->id);

        return $this->sendResponse('', $success);
    }

    // search order
    public function search_order(string $key_word)
    {
        $user = auth()->user();
        $success = $this->orderService->search_order($user->id,$key_word);

        return $this->sendResponse('', $success);
    }

    //create new order
    public function create_order($user_id, $location, $total_price, $items, $total)
    {
        $user = auth()->user();
        $success = $this->orderService->create_order($user_id, $location, $total_price, $items, $total);

        return $this->sendResponse('', $success);

    }

    //update order
    public function update_order($user_id, $location, $total_price, $items, $total,$order_status)
    {
        $user = auth()->user();
        $success = $this->orderService->update_order($user_id, $location, $total_price, $items, $total,$order_status);
        if(!$success)
            return 'this order is not pending please create a new order';
        return $this->sendResponse('messages.updated_successfully' ,$success);
    }

    //delete order
    public function delete_order($order_id)
    {
        $user = auth()->user();
        $success = $this->orderService->delete_order($order_id);
        if(!$success)
            return 'this order is not existing';
        return $this->sendResponse('messages.deleted_successfully' ,$success);
    }
}
