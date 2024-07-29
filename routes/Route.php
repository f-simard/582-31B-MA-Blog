<?php

namespace App\Routes;

class Route {
	private static $routes = [];

	public static function get($url, $controller){
		self::$routes[] = ['url'=>$url, 'controller' => $controller, 'method' => 'GET'];
	}

	public static function post($url, $controller){
		self::$routes[] = ['url'=>$url, 'controller' => $controller, 'method' => 'POST'];
	}

	public static function dispatch(){
		//print_r(self::$routes);

		$url = $_SERVER['REQUEST_URI'];
		$urlSegments = explode('?', $url);   //pour url get, separer avant et apres ? dans url
		//print_r($urlSegments);
		$urlPath = rtrim($urlSegments[0], "/'");
		// echo $urlPath;
		$method = $_SERVER['REQUEST_METHOD'];
		//echo $method;

		foreach(self::$routes as $route){
			// echo ' == ' BASE.$route['url'];
			if (BASE.$route['url'] == $urlPath && $route['method'] == $method )
			{
				$controllerSegments = explode('@', $route['controller']);
				$controllerName = "App\\Controllers\\".$controllerSegments[0];
				$methodName = $controllerSegments[1];

				// echo $controllerName .'<br>' . $methodName;
				// echo ' <br> oui';

				$controllerInstance = new $controllerName();
				
				if($method == 'GET'){
					$controllerInstance->$methodName();
				} elseif ($method == 'POST'){

				}

				return;
				
			// } else {
			// 	echo '<br>non';
			// }
		   }
		}
		http_response_code(404);
		echo "404 not found";
	}
}