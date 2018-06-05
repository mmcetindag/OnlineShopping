<?php
	function escape($value){
		return trim(htmlentities(htmlspecialchars($value)));
	}
	function redirect($location){
		header("Location: {$location}");
		exit();
	}

	function time_ago($session_time){
		if (empty($session_time)) {
			return false;
			exit();
		}
	    $time_difference = time() - $session_time;
	    $seconds = $time_difference;
	    $minutes = round($time_difference / 60);
	    $hours = round($time_difference / 3600);
	    $day = round($time_difference / 86400);
	    $weeks = round($time_difference / 604800);
	    $months = round($time_difference / 2419200);
	    $year = round($time_difference / 29030400);

	    if($seconds <= 60){
	      return $seconds." Seconds ago";
	    }
	    else if ($minutes <= 60){
	      if($minutes == 1){
	        return "One Minute ago";
	      }else{
	        return $minutes." Minutes ago";
	      }
	    }
	    else if($hours <= 24){
	      if($hours == 1){
	        return "One Hour ago";
	      }else{
	        return $hours." Hours ago";
	      }
	    }
	    else if($day <= 7){
	      if($day == 1){
	        return "One day ago";
	      }else{
	        return $day." days ago";
	      }
	    }
	    else if($weeks <= 4){
	      if($weeks == 1){
	        return "One week ago";
	      }else{
	        return $weeks." weeks ago";
	      }
	    }
	    else if($months <= 12){
	      if($months == 1){
	        return "One month ago";
	      }else{
	        return $months." months ago";
	      }
	    }
	    else{
	      if($year == 1){
	        return "One year ago";
	      }else{
	        return $year." years ago";
	      }
	    }
	 }

	 function random_password() {
			 $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			 $pass = array(); 
			 $alphaLength = strlen($alphabet) - 1; 
			 for ($i = 0; $i < 8; $i++) {
					 $n = rand(0, $alphaLength);
					 $pass[] = $alphabet[$n];
			 }
			 return implode($pass); 
	 }

	function get_extension($file){
			$file = strtolower($file);
			$explode = explode(".", $file);
			$key = count($explode) - 1;
			return $explode[$key];
	}

	
	function encryption($action, $string) {
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = '@@#$%^&()_+Si';
	    $secret_iv = 'Teri Bhen ki chut';

	
	    $key = hash('sha256', $secret_key);
	 
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

	function not_login($id, $url){
		if (!isset($id)) {
			redirect($url);
		}
	}

	function is_login($id, $url){
		if (isset($id)) {
			redirect($url);
		}
	}

?>
