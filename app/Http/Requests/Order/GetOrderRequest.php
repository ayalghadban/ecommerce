<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetOrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
        ];
    }
}
