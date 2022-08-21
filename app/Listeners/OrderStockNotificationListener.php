<?php

namespace App\Listeners;

use App\Events\OrderStockEvent;
use App\Mail\IngredientStockMessage;
use App\Models\Ingredient;
use App\Models\IngredientNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrderStockNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderStockEvent  $event
     * @return void
     */
    public function handle(OrderStockEvent $event) {

        $ingredientsNotificationEmail = array();

        $ingredientsNotification = Ingredient::query()
            ->whereDoesntHave('ingredientNotification')
            ->orWhereHas('ingredientNotification', function ($p){
                $p->where('has_sent', '0');
            })->get()
            ->toArray();

        $adminUser = User::query()
            ->where('role', 'admin')
            ->first();

        foreach ($ingredientsNotification as $key => $ingredient) {

            if($ingredient['stock_value'] <= ($ingredient['original_value'] / 2)) {
                $ingredientsNotificationEmail[$key]['name'] = $ingredient['name'];
                $ingredientsNotificationEmail[$key]['value'] = $ingredient['stock_value'];

                if(!empty($adminUser)) {
                    IngredientNotification::create([
                        'user_id'       => $adminUser->id,
                        'ingredient_id' => $ingredient['id'] ,
                        'has_sent'      => '1'
                    ]);
                }
            }
        }

        if(!empty($ingredientsNotificationEmail)) {
            try {
                Mail::to($adminUser->email)->send(new IngredientStockMessage($ingredientsNotificationEmail));
            } catch (\Exception $e) {

            }
        }
    }
}
