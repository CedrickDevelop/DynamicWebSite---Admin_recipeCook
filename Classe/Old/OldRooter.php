<?php
namespace classe;

class Rooter {
	private $namespace;
	private $method;
	
	public function __construct($namespace, $method) {
		$this->namespace = $namespace;
		$this->method   = $method;
	}
	
	public function ChooseController() {
			$namespace = $this->namespace;
			$method   = $this->method;


			 if(method_exists($namespace, $method) ) {
                 $object = new $namespace();
                 $object->$method();
             }else {
                 exit;
             }


	}
}