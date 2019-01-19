<?php
namespace ThisApp\Core;
#llamar las instancias
use \Illuminate\Http\Request;
use \ThisApp\Aplication\Security\ErrorLog;
use \ThisApp\Aplication\System\Response;

class Router extends Request
{	
	protected $_resource;
	protected $_detail;
	protected $_verb;

	public function __construct(Request $request)
	{	
		//Get the verb of the request
		$this->_verb = strtolower($request->method());
		$url = explode('/', filter_var(trim($request->getPathInfo(),'/'),FILTER_SANITIZE_URL));
		//Check if the requested resource exists
		if(file_exists('../app/Resources/'.ucfirst(strtolower($url[0])).'.php'))
		{
			//The resource does exist!
			$this->_resource = ucfirst(strtolower($url[0]));
			unset($url[0]);
		}else{
			//The resource does NOT exist!
			Response::json(array('error' => 'Resource not found'), 404);
		}
		//Call the requested respirce
		$theResource = "ThisApp\Resources\\".$this->_resource;
		//Verify if is ther any resource detail
		if (!isset($url[1])) {
			//There is no detail, so the default verb methos is asigned
			$detail = $this->_verb.'Default';
		}else{
			//The is a detail on the requeste
			$detail = $this->_verb.ucfirst(strtolower($url[1]));
			unset($url[1]);	
		}
		//Check if the detail method exists on the resource class
		if (method_exists($theResource, $detail)) {
			//it exists
			$this->_detail = $detail;				
		}else{
			//It doesn't exists so throw an error
			Response::json(array('error' => 'Resource detail not found'), 404);
		}
	    //Instanciate the resource
		$this->_resource = new $theResource($request);
		call_user_func_array([$this->_resource, $this->_detail], array("actions" => array_values($url)));
	}
}
