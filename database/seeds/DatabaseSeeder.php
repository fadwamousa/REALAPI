<?php


use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS =  0');

        //delete all data from tables 
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();


        $userQTY = 150;
        $cateQTY = 30;
        $prodQTY = 1000;
        $tranQTY = 1000;

        factory(App\User::class,$userQTY)->create();

        factory(App\Category::class,$cateQTY)->create();

        factory(App\Product::class,$prodQTY)->create()->each(function($product){

          $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

          $product->categories()->attach($categories);

        });

        factory(App\Transaction::class,$tranQTY)->create();





    }
}
