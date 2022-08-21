<?php

namespace App\Http\Controllers;

use App\Events\OrderStockEvent;
use App\Models\ProductIngredient;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * create an order
     */
    public function store(Request $request) {

        try {

            $requestData = array(
                'productId' => $request->product_id,
                'quantity'  => $request->quantity
            );
            // validating the request data
            $validator = \Validator::make($requestData, [
                'productId' => 'required|integer|exists:products,id',
                'quantity'  => 'required||integer'
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }

            $orderServices      = new OrderService();
            // // get ingredient by product_id
            $productIngredients = ProductIngredient::query()
                ->whereHas('ingredient')
                ->where('product_id', $request->product_id)
                ->with('ingredient')->get();

            $ingredientInStock = $orderServices->orderAvailability($productIngredients, $request);

            if(isset($ingredientInStock['status']) && $ingredientInStock['status'] == false) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not enough ' . $ingredientInStock['message'] . ' in our stock'
                ]);
            }
            try {
                // create order
                $order = $orderServices->createOrder($request);
                if($order->exists) {
                    // update stock values
                    $orderServices->updateStock($productIngredients, $order, $request);
                    event(new OrderStockEvent($order));

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Your order placed!'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
