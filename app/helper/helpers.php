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
	if(session()->get('USER_TEMP_ID')===null){
		$rand=rand(111111111,999999999);
		session()->put('USER_TEMP_ID',$rand);
		return $rand;
	}else{
		return session()->has('USER_TEMP_ID');
	}
}

function getAddToCartTotalItem(){
	if(session()->has('FRONT_USER_LOGIN')){
		$uid=session()->get('FRONT_USER_LOGIN');
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

?>