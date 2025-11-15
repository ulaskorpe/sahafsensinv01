<?php

namespace App\Observers;

use App\Mail\ProductUpdatedMail;
//use App\Mail\UserCreatedEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class ProductObserver
{
 
    public function created(Product $product){

    if(empty($product['verified'])){
        $txt = $product['title'] ." isimli ürününüz sitemize eklenmiştir. Yayını onaylandığında bilgilendirleceksiniz";
    }else{
        $txt = $product['title'] ." isimli ürününüz sitemize eklenmiş ve onaylanmıştır";
    }
     
          // Mail::to($product->user()->first()->email)->send(new ProductUpdatedMail($txt,'ürününüz eklendi'));


           $cat = Category::find($product['category_id']);
           $cat->product_count = $cat['product_count']+1;
           $cat->save();

         //  Log::channel('data_check')->info($txt."::".$product->user()->first()->email);
    }

    public function saved(Product $product){
        $txt = $product['title'];
        if($product->isDirty('verified')){
         
            $txt .= ($product['verified']) ? 'Ürününüz onaylandı ':'ürün onayınız kaldırıldı';
        }
        if($product->isDirty('category_id')){
            $cat = Category::find($product['category_id']);
            $cat->product_count = $cat['product_count']+1;
            $cat->save();


            $cat = Category::find($product->getOriginal('category_id'));
            $cat->product_count = $cat['product_count']-1;
            $cat->save();

        }

        if($product->isDirty('winner_id')){

        }
   //  Mail::to($product->user()->first()->email)->send(new ProductUpdatedMail($txt,'ürününüz güncellendi'));
    //        Log::channel('data_check')->info($txt);
    }

    public function updated(Product $product){

    }
 
}
