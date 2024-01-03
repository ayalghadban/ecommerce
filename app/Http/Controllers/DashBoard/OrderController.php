<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\GetOrderRequest;
use App\Http\Resources\Base\BaseCollection;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private OrderService $_service ; 

    public function __construct(OrderService $service){
        
        $this->_service = $service ; 
    }
    public function getAllOrder(Request $request){

        $per_page  = $request->per_page??8 ; 
        $search = $request->search ?? null ; 
        $success = $this->_service->getAllWithPaginate(BaseCollection::class ,$per_page ,$search );

        return $this->sendResponse('', $success);
    }
    public function getOrder(GetOrderRequest $request){

        $success = $this->_service->getOrder($request->order_id);

        return $this->sendResponse('', $success);

    }

    public function acceptPendingOrder(GetOrderRequest $request)
    {
        $order_status_is_pending = $this->_service->check_order_status($request->order_id, 'pending');
        if ($order_status_is_pending) {
            $success = $this->_service->accept_pending_order($request->order_id);

            return $this->sendResponse(__('messages.change_order_status_successfully'), $success);
        } else {
            return $this->sendError(__('messages.order_status_is_not_pending'), 400);
        }
    }

    public function cancelOrder(GetOrderRequest $request)
    {
        $order_status_is_delivered = $this->_service->check_order_status($request->order_id, 'delivered');
        if (!$order_status_is_delivered) {
            $success = $this->_service->cancel_order($request->order_id);

            return $this->sendResponse(__('messages.change_order_status_successfully'), $success);
        } else {
            return $this->sendError(__('messages.order_cannot_cancel'), 400);
        }
    }

    public function deliveringAcceptedOrder(GetOrderRequest $request)
    {
        $order_status_is_accepted = $this->_service->check_order_status($request->order_id, 'accepted');
        if ($order_status_is_accepted) {
            $success = $this->_service->delivering_accepted_order($request->order_id);

            return $this->sendResponse(__('messages.change_order_status_successfully'), $success);
        } else {
            return $this->sendError(__('messages.order_status_is_not_accepted'), 400);
        }
    }

    public function makeOrderDelivered(GetOrderRequest $request)
    {
    
        $order_status_is_delivering = $this->_service->check_order_status($request->order_id, 'delivering');
        if ($order_status_is_delivering) {
            $success = $this->_service->make_order_delivered($request->order_id);

            return $this->sendResponse(__('messages.change_order_status_successfully'), $success);
        } else {
            return $this->sendError(__('messages.order_status_is_not_delivering'), 400);
        }
    }

    public function deleteOrder(GetOrderRequest $request)
    {
        $success = $this->_service->delete_order($request->order_id);
        return $this->sendResponse(__('messages.deleted_successfully'), $success);
    }
}
