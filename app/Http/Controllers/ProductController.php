<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function postProducts(){
        return 'Post Products from Product Controller';
    }

    public function getProducts(){
        return 'Get all Products from Product Controller';
    }

    public function getProductById($id){
        return 'Get Products '. $id;
    }
}
