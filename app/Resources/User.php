<?php
namespace ThisApp\Resources;

use \ThisApp\Aplication\System\Response;
use \ThisApp\Aplication\Security\ErrorLog;
use \ThisApp\Aplication\Security\Hash;
use \ThisApp\Aplication\Functions\Validate;


class User {

	private $_request, $_qs, $_state = "";

	public function __construct($request = null){
		$this->_request =  $request;
		$this->_qs = $request->all();
	}

  public function getDefault($ids = null){
    $this->validation(array(
      array('name'=> 'id', 'is_numeric' => true, 'type' => 'integer'),
      array('name'=> 'name', 'len' => 15),
      array('name'=> 'age', 'is_numeric' => true, 'type' => 'integer', 'min' => 18)
    ));

    Response::json(array('data' => 'Hello, '. ucfirst($this->_qs['name']).', you are '.$this->_qs['age'].' years old and your id is: '.$this->_qs['id'].', thanks for using this app. Bye!'), 200);
  }

  public function  getAll(){    

  }


  public function postSingle(){

  }

  public function deleteSingle(){

  }

  public function patchSingle(){

  }

  private function validation(Array $required){
    if (!Validate::query_string($required, $this->_qs, $this->_state))
      Response::json(array('error' => $this->_state), 400);
    else
      return true;
  }
}