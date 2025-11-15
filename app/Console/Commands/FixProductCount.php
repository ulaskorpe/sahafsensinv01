<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Product;
class FixProductCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-product-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cats = Category::select('id')->get();
        foreach($cats as $cat){
            $count = Product::where('category_id','=',$cat['id'])->count();
            $cat->product_count = $count;
            $cat->save();
        }
    }
}
