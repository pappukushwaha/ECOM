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


?>