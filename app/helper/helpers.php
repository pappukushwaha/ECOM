<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat(){
    $result=DB::table('categories')
    ->where(['status'=>1])
    ->get();
    $arr=[];
    $html = '';
    $html = '<ul class="nav navbar-nav">';
foreach($result as $row){
$data = $arr[$row->id]['name']=$row->category_name.'<br>';
$html .= '<li><a href="/category/'.$row->category_slug.'">'.$data.'</a></li>';
}
$html .= '</ul>';
return $html;
}

function getUserTempId(){
	if(!session()->has('USER_TEMP_ID')){
		$rand=rand(111111111,999999999);
		session()->put('USER_TEMP_ID',$rand);
		return $rand;
	}else{
		return session()->get('USER_TEMP_ID');
	}
}

function getAddToCartTotalItem(){
	if(session()->has('FRONT_USER_LOGIN')){
		$uid=session()->get('FRONT_USER_ID');
		$usertype="Reg";
	}else{
		$uid=getUserTempId();
		$usertype="Not-Reg";
	}
	$result=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colores','colores.id','=','product_attr.color_id')
            ->where(['userid'=>$uid])
            ->where(['usertype'=>$usertype])
            ->select('cart.qty','products.name','products.image','sizes.size','colores.color','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
            ->get();

	return $result;
   
}

function apply_coupon_code($coupon_code){
    $result=DB::table('coupons')
        ->where(['coupon_code'=>$coupon_code])
        ->get();
        $totalPrice = 0;

        if(isset($result[0])){
            $value = $result[0]->coupon_value;
            $type = $result[0]->type;
            if($result[0]->status==1){
                if($result[0]->is_one_time ==1){
                    $status = 'error';
                    $msg = 'Coupon code already used';
                }else{
                    $min_order_amount = $result[0]->min_order_amount;
                    if($min_order_amount>0){
                        $getAddToCartTotalItem = getAddToCartTotalItem();
                        foreach($getAddToCartTotalItem as $list){
                           $totalPrice = $totalPrice+($list->qty * $list->price);
                        }
                        if($min_order_amount<$totalPrice){
                            $status = 'success';
                            $msg = 'Coupon code applied';
                        }else{
                            $status = 'error';
                            $msg = 'It should be Cart amount must be greater then '.$min_order_amount;
                        }
                    }else{
                        $status = 'success';
                       $msg = 'Coupon code applied';
                    }
                }
            }else{
                $status = 'error';
                $msg = 'Coupon code deactivated';
            }
        }else{
            $status = 'error';
            $msg = 'please Enter Valid Coupon Code';
        }
         $coupon_code_value = 0;
        if($status == 'success'){
            if($type == 'Value'){
                $coupon_code_value = $value;
             $totalPrice = $totalPrice - $value;
            }
            if($type == 'Per'){
               $totalPriceper = round(($value/100)*$totalPrice);
               $totalPrice = $totalPrice-$totalPriceper;
               $coupon_code_value = $totalPriceper;
            }
        }
        return json_encode(['status'=>$status, 'msg'=>$msg, 'amount'=>$totalPrice, 'coupon_code_value'=>$coupon_code_value]);

}

?>