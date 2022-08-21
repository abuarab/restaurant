<?php

namespace App\Services;

use App\Helpers\CommonHelper;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Support\Str;

class OrderService {

    /**
     * @param $productIngredients
     * @return array
     *
     * * check if the ingredients
     */
    public function orderAvailability($productIngredients, $request) {

        $quantity = $request->quantity;
        foreach($productIngredients as $ingredient) {

            $ingredientQuantity = CommonHelper::convertGToKg($ingredient->ingredient_value * $quantity);
            $ingredientStock = Ingredient::query()
                ->where('id', $ingredient->ingredient_id)
                ->where('stock_value', '>', $ingredientQuantity)
                ->get();

            if($ingredientStock->isEmpty()) {
                return ['status' => false, 'message' => $ingredient->ingredient->name];
            }
        }

        return ['status' => true, 'message' => 'success'];
    }

    /**
     * @param $request
     * @return mixed
     *
     * create order
     */
    public function createOrder($request) {

        $order = Order::create([
            'order_number'  => Str::random(5),
            'user_id'       => Auth()->id(),
            'product_id'    => $request->product_id,
            'quantity'      => $request->quantity
        ]);

        return $order;
    }

    /**
     * @param $productIngredients
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     *
     * update stock and order log
     */
    public function updateStock($productIngredients, $order, $request) {

        $quantity = $request->quantity;
        foreach($productIngredients as $ingredient) {
            // convert weight
            $newValueInG = CommonHelper::convertKgToG($ingredient->ingredient->stock_value) - ($ingredient->ingredient_value * $quantity);
            $newValue    = CommonHelper::convertGToKg($newValueInG);
            try {
                // update new value
                Ingredient::where('id', $ingredient->ingredient_id)
                    ->update(['stock_value' => $newValue]);
                // add to the history / log
                OrderHistory::create([
                    'order_id'      => $order->id,
                    'ingredient_id' => $ingredient->ingredient_id,
                    'old_value'     => CommonHelper::convertKgToG($ingredient->ingredient->stock_value),
                    'value'         => $newValueInG,
                    'measure_id'    => $ingredient->ingredient_measure_id
                ]);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
}
