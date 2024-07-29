<?php
class Route {
	private static $routes = [];

	public static function get($url, $controller){
		self::$routes[] = ['url'=>$url, 'controller' => $controller, 'method' => 'GET'];
	}

	public static function post($url, $controller){
		self::$routes[] = ['url'=>$url, 'controller' => $controller, 'method' => 'POST'];
	}

	public static function dispatch() {

		$url = $_SERVER['REQUEST_URI'];
		$urlSegments = explode('?', $url);
		$urlPath = rtrim($urlSegments[0], "/'");
		$method = $_SERVER['REQUEST_METHOD'];

		foreach(self::$routes as $route){

			if (BASE.$route['url'] == $urlPath && $route['method'] == $method ) {
				
				$controllerSegments = explode('@', $route['controller']);
				$controllerName = $controllerSegments[0];
				$methodName = $controllerSegments[1];

				$controllerInstance = new $controllerName();
				
				if($method == 'GET'){
					$controllerInstance->$methodName();
				} elseif ($method == 'POST'){

				}

				return;
		
		   }
		}
		http_response_code(404);
		echo "404 not found";
	}
}