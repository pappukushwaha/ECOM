<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ProductReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductReviews extends Controller
{
    public function index(){
        $result['data']=
            DB::table('product_review')
            ->leftJoin('customers','customers.id','=','product_review.customer_id')
            ->leftJoin('products','products.id','=','product_review.product_id')
            ->orderBy('product_review.added_on', 'desc')
            ->select('product_review.id','product_review.rating', 'product_review.status', 'product_review.review', 'product_review.added_on', 'customers.name', 'products.name as pname')
            ->get();
            // prx($result['data']);
        return view('admin_login/product_review', $result);
    }

    public function product_review_update($status, $id){
        DB::table('product_review')
        ->where(['id'=>$id])
        ->update(['status'=>$status]);
        return redirect('/product_review');
        // echo $status;
    }
}
