<?php
//http://stackoverflow.com/questions/369602/how-to-delete-an-element-from-an-array-in-php
/* hook functions */
//it is possible to loop through the hook array
//currently param array is not an array but rather a string
function hook_insert($hook_name,$param_array = ''){
	global $hook;
	
	
	if(!empty($hook[$hook_name])){
			$hk = $hook[$hook_name];
				if(!empty($hk)){
					foreach($hk as $h){//loop thru a named hook array ex:   $hook['body'][10] = 'get_body';
					{
						$h($param_array) ;
					}
				}
			}
	}
	
}


//remove hook
function remove_hook($url = ''){
	return;
}


//parse query string

function parse_query_string($query_string){
	 $m = explode('&',$query_string);
	for($i=0;$i<count($m);$i++){
		//extract arguments
			$a = explode('=',$m[$i]);
			$argument[$i]['param'] = $a[0];
			$argument[$i]['value'] = $a[1];
	}
	
	return $argument;

}