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
       $data = $arr[$row->id]['city']=$row->category_name.'<br>';
		$html .= '<li><a href="#">'.$data.'</a></li>';
    }
	$html .= '</ul>';
	return $html;

    
}

function getrandomuserid(){
    if(session()->has('USER_TEMP_ID')===null){
        $rand = rand(111111111,999999999);
        session()->put('USER_TEMP_ID', $rand);
        return $rand;
    }else{
        return session()->has('USER_TEMP_ID');
         
    }
}

function getcartget(){
    if(session()->has('FRONT_USER_LOGIN')){
        $uid = session()->get('USER_LOGIN');
        $user_type = "Reg";
     }else{
        $uid = getrandomuserid();
        $user_type = "Not-Reg";
     }
    $result= DB::table('cart')
    ->leftjoin('products','products.id','=','cart.product_id')
    ->leftjoin('product_attr','product_attr.id','=','cart.product_attr_id')
    ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
    ->leftjoin('colores','colores.id','=','product_attr.color_id')
    ->where(['userid'=>$uid])
    ->where(['usertype'=>$user_type])
    ->select('products.name', 'products.image', 'cart.qty', 'sizes.size','colores.color', 'product_attr.price', 'products.slug', 'products.id as pid', 'product_attr.id as attrid')
    ->get();
     return $result;
}


?>