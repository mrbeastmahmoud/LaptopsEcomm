<?php

namespace App\Http\Services;

use App\Models\Lap;

class ProductService
{
public function getRelatedProducts(Lap $product){
    $categoryId =$product->id_brand;
    $laptops= Lap::where('id_brand',$categoryId)->get();
   return $laptops;

}

}








