<?php

class Segmentation {
	
	public $actual = array('locale' => null, 'audience' => null);
	
	protected $redirect = false;
	
	protected $possible = array(
		'locale' => array('intl','usa'),
		'audience' => array('teachers','facilitators','students')
	);
	
	public function __construct() {
		
		$this->setup_segment('locale');
		$this->setup_segment('audience');
		
		if($this->redirect) {
			if(is_null($this->actual['audience'])) {
				header('Location: /');
			} else {
				header('Location: /audience/'.$this->actual['audience'].'/');
			}
			exit;
		}
		
	}
	
	protected function setup_segment($key) {
		
		if(isset($_POST['ns-'.$key])) {
			
			if($this->is_accepted($_POST['ns-'.$key], $key)) {
				setcookie($key, $_POST['ns-'.$key], time() + 3600, '/');
				$this->actual[$key] = $_POST['ns-'.$key];
				$this->redirect = true;
			} else {
				if(isset($_COOKIE[$key])) {
					setcookie($key,'',0,'/');
				}
 			}
			
		} else if(isset($_COOKIE[$key])) {
			
			if($this->is_accepted($_COOKIE[$key], $key)) {
				$this->actual[$key] = $_COOKIE[$key];
			}
			
		} else {
			
			if($key == 'locale') {
				
				if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'us.iearn.org') !== false) {
					
					$this->reset_segment('usa','locale');
					
				} else {
					
					$location = json_decode(file_get_contents('http://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json'));
					
					if(isset($location->country) && $location->country == 'US') {
						$this->reset_segment('usa','locale');
					} else {
						$this->reset_segment('intl','locale');
					}
					
				}
				
			}
			
		}
		
	}
	
	public function reset_segment($val, $key) {
				
		if($this->is_accepted($val, $key)) {
			setcookie($key, $val, time() + 3600, '/');
			$this->actual[$key] = $val;
		}
		
	}
	
	protected function is_accepted($val, $key) {
		
		if(array_key_exists($key, $this->possible)) {
			return in_array($val, $this->possible[$key], true);
		} else {
			return true;
		}
		
	}
	
}

?>