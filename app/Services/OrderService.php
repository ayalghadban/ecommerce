<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function get_user_orders($user_id)
    {
        $data = [];

        $orders = Order::where('user_id', $user_id)
        ->select(['user_id','location',
        'total_price','totals',
        'items','order_status',])
        ->orderBy('created_at', 'DESC')->get();

        $data['order'] = $orders;
        $data['order_all_total'] = Order::where('user_id', $user_id)->sum('order_total');
        return $data;
    }

    //search for orders
    public function search_order($user_id,$key_word)
    {
        $search = Order::where('items','LIKE', '%'.$key_word.'%')->get();
        if($key_word = null)
            return($this->get_user_orders($user_id));
        return $search;
    }

    //create a new order
    public function create_order($user_id, $location, $total_price, $items, $totals)
    {
        $order = Order::create([
            'user_id' => $user_id,
            'location' => $location,
            'total_price' => $total_price,
            'totals' => json_encode($totals),
            'items' => json_encode($items['products']),
            'order_status' => 'pending',
        ]);

        return $order;
    }

    //update a order
    public function update_order($user_id, $location, $total_price, $items, $totals,$order_status)
    {
        $update = [];
        if($order_status == 'pending')
        {
            $update = Order::where('user_id', $user_id)->update([
                'location' => $location,
                'total_price' => $total_price,
                'totals' => json_encode($totals),
                'items' => json_encode($items),
            ]);
            $update = Order::where('user_id', $user_id)->get();
            return $update;
        }
        else return false;
    }

    // delete order
    public function delete_order($order_id)
    {
        $delete = Order::where('id', $order_id)->delete();
        return true;
    }
}
