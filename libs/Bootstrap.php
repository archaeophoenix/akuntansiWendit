<?php
class Bootstrap {
	
	private $x = null;
	private $controller = null;
	
	private function geturl(){
		$x = (isset($_GET['x'])) ? $_GET['x'] : NULL ;
		$x = rtrim($x,'/');
		$x = filter_var($x,FILTER_SANITIZE_URL);
		$this->x = explode('/', $x);
	}

	private function load($url){
		$file1 = 'controllers/'.strtolower($url).'.php';
		$file2 = 'controllers/'.strtoupper($url).'.php';
		$file3 = 'controllers/'.ucwords(strtolower($url)).'.php';
		
		if(file_exists($file1)){
			$file = $file1;
			$page = strtolower($url);
		} elseif (file_exists($file2)) {
			$file = $file2;
			$page = strtoupper($url);
		} elseif (file_exists($file3)) {
			$file = $file3;
			$page = ucwords(strtolower($url));
		} else {
			$file = 'controllers/'.route.'.php';
			$page = route;
		}

		require $file;
		$this->controller = new $page;
		$this->controller->useModel($page);
	}
	
	private function methodcontroller(){
		$func = (!empty($this->x[1])) ? $func = $this->x[1] : null ; 
		if (method_exists($this->controller,$func)){
			if (!empty($this->x[2])) {
				array_shift($this->x);
				array_shift($this->x);
				call_user_func_array(array($this->controller,$func),$this->x);
			} else {
				$this->controller->{$func}();
			}
		} elseif (!method_exists($this->controller,$func)){
			$this->controller->index();
		} else {
			$this->notfound($func);
		}
	}

	function start() {
		$this->geturl();
		$this->load($this->x[0]);
		$this->methodcontroller();
	}

	private function notfound($page){
		echo "404<br>page ".$page." not found";
	}
}