<?php

use Faker\Generator as Faker;
use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use App\Seller;


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verified' => $verified = $faker->randomElement([User::UNVERIFIED_USER,User::VERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $verified = $faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description'=>$faker->paragraph(1),//only one paragrah
    ];
});


$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description'=>$faker->paragraph(1),//only one paragrah
        'quantity' => $faker->numberBetween(1,10),
        'status'   => $faker->randomElement([Product::AVAILABLE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
        'image'    => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'seller_id'=> function(){
          return User::all()->random();
        }
    ];
});


$factory->define(App\Transaction::class, function (Faker $faker) {

    $seller = Seller::has('products')->get()->random();
    $buyer  = User::all()->except($seller->id)->random();

    return [
        'quantity'   => $faker->numberBetween(1,3),
        'product_id' => $seller->products->random()->id,
        'buyer_id'   => $buyer->id
    ];
});
