<?php

namespace App\Services;

use App\Models\Order;
use App\Services\BaseCrud\CrudService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

/**
 * Class RafeeqDeliveryService
 * @package App\Services
 */
class OrderService extends CrudService
{

    public function __construct()
    {
        parent::__construct(new Order());
    }

    public function getOrder(int $order_id)
    {

        return Order::with('customer' , function($query){
            $query->with('address');
        })->find($order_id);
    }

    public function getAllWithPaginate($Resource,  $per_page = 8, $search = null)
    {
        $data = (new Order)->with(['customer']);

        if (isset($search)) {

            $search_keyword = $search->key;
            $search_value = $search->value;

            $data->where($search_keyword, 'LIKE', '%' . $search_value . '%');
        }

        $data = new $Resource($data->paginate($per_page));

        return $data;
    }



    public static function createOrder( $user_id, $order_total, $items, $totals)
    {
        $order = Order::create([
            'customer_id' => $user_id,
            'order_total' => $order_total,
            'totals' => json_encode($totals),
            'items' => json_encode($items['products']),
            'order_status' => 'pending',
        ]);
        return $order;
    }

    public static function getUserOrders($user_id, $per_page = 8)
    {
        $data = [];

        $orders = Order::where('customer_id', $user_id)
        ->select(['id', 'customer_id','created_at', 'order_status', 'order_total'])
        ->orderBy('created_at', 'DESC')->get();

        $data['order'] = $orders;
        $data['order_all_total'] = Order::where('customer_id', $user_id)->sum('order_total');
        return $data;
    }

    public static function getOrderTrackDetails($order_id)
    {
        $data = [];

        $order = Order::where('id', $order_id)->first();

        $order->totals = json_decode($order->totals);
        $order->items = json_decode($order->items);

        $data = $order;

        return $data;
    }

    public static function checkIfUserDidOrder($user_id, $order_id)
    {
        $order = Order::where([['id', $order_id], ['customer_id', $user_id]])->first();
        if (!$order) {
            return false;
        } else {
            return true;
        }
    }

    public static function check_order_status($order_id, $desired_order_status)
    {
        $order = Order::where('id', $order_id)->first();
        if ($order->order_status == $desired_order_status) {
            return true;
        } else {
            return false;
        }
    }

    public static function accept_pending_order($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->order_status = 'accepted';
        $order->save();

        //FirebaseService::send_notification($order->customer_id, new OrderAccepted);

        return [];
    }

    public static function delivering_accepted_order($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->order_status = 'delivering';
        $order->save();


        return [];
    }

    public static function make_order_delivered($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->order_status = 'delivered';
        $order->save();

        return [];
    }

    public static function cancel_order($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->order_status = 'canceled';
        $order->items = json_decode($order->items);

        $order->save();

        return [];
    }

    public static function delete_order($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->delete();

        return [];
    }
}
