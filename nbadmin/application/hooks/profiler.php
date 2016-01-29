<?php

function profiler_hook() {
	
	
	function ip_is_private($ip) {
			$pri_addrs = array(
					'103.24.96.108|103.24.96.126', //ADmin
					'110.34.32.77|110.34.32.78', //DB Admin
					'124.29.206.244|124.29.206.245', //DB Admin
				);

			$long_ip = ip2long($ip);
			if($long_ip != -1) {

				foreach($pri_addrs AS $pri_addr)
				{
					list($start, $end) = explode('|', $pri_addr);

					 // IF IS PRIVATE
					 if($long_ip >= ip2long($start) && $long_ip <= ip2long($end))
					 return (TRUE);
				}
		}
		return (FALSE);
	}
	
	if (ip_is_private($_SERVER['REMOTE_ADDR'])){
/*		
		$CI =& get_instance();
			$CI->output->enable_profiler();
*/
	}
	
}
