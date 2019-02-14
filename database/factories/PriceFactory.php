<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Price::class, function (Faker $faker) {
    $products_ids = \App\Product::all()->pluck('id')->toArray();
    $id = $faker->randomElement($products_ids);
    $v = \App\Price::where('product_id',$id)->pluck('variant')->toArray();
    if(count($v) > 0){
        $av_v = [1,2,3,4];
        foreach($v as $i){
            unset($av_v[array_search($i, $av_v)]);
        }
    }
    else{
        $av_v = [1,2,3,4];
    }
    return [
        'product_id' => $id,
        'price' => $faker->randomFloat(2,0,100),
        'variant' => $faker->randomElement($av_v)
    ];
});

