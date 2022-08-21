<?php

namespace App\Observers;

use App\Mail\IngredientStockMessage;
use App\Models\Ingredient;
use App\Models\IngredientNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class IngredientObserver
{
    /**
     * Handle the Ingredient "created" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function created(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the Ingredient "updated" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function updated(Ingredient $ingredient)
    {
        IngredientNotification::create([
            'user_id'       => 3,
            'ingredient_id' => 1 ,
            'has_sent'      => '1'
        ]);

        die();
        $ingredientsNotificationEmail = array();

        $ingredientsNotification = Ingredient::query()
            ->whereDoesntHave('ingredientNotification')
            ->orWhereHas('ingredientNotification', function ($p){
                $p->where('has_sent', '0');
            })->get()
            ->toArray();

        foreach ($ingredientsNotification as $ingredient) {

            if($ingredient['stock_value'] <= ($ingredient['original_value'] / 2)) {
                array_push($ingredientsNotificationEmail, $ingredient['name']);

                $adminUser = User::query()
                    ->where('role', 'admin')
                    ->first();

                if(!empty($adminUser)) {
                    IngredientNotification::create([
                        'user_id'       => $adminUser->id,
                        'ingredient_id' => $ingredient['id'] ,
                        'has_sent'      => '1'
                    ]);
                }
            }
        }

//        Mail::to('ama91@live.com')->send(new IngredientStockMessage());
    }

    /**
     * Handle the Ingredient "deleted" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function deleted(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the Ingredient "restored" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function restored(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the Ingredient "force deleted" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function forceDeleted(Ingredient $ingredient)
    {
        //
    }
}
