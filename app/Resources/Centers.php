<?php
namespace ThisApp\Resources;

use \ThisApp\Aplication\System\Response;
use \ThisApp\Aplication\Security\ErrorLog;
use \ThisApp\Aplication\Security\Hash;
use \ThisApp\Aplication\Functions\Validate;
use \ThisApp\Models\Centers as mCenters;


class Centers {

	private $_request, $_qs, $_state = "";

	public function __construct($request = null){
		$this->_request =  $request;
		$this->_qs = $request->all();
	}

  

  public function getFree(){
     if(!isset($this->_qs['userkey']) || $this->_qs['userkey'] !== 'r3c0v3rySp34k3r5S34rch3ng1n3U53r')
        Response::json(array('Unauthorized'), 403);

     $this->validation(array(
      array('name'=> 'limit', 'is_numeric' => true, 'type' => 'integer', 'min' => 0),
      array('name'=> 'offset', 'is_numeric' => true, 'type' => 'integer')
    ));

    $oC = new mCenters();
    $results = $oC->paginate_all_free_active_ads($this->_qs['limit'], $this->_qs['offset']);
    if($results === false)
      Response::json(array('data' => array()), 200);
    Response::json(array('data' => $results), 200);
  }

  public function getZip(){
     if(!isset($this->_qs['userkey']) || $this->_qs['userkey'] !== 'r3c0v3rySp34k3r5S34rch3ng1n3U53r')
        Response::json(array('Unauthorized'), 403);

     $this->validation(array(
      array('name'=> 'limit', 'is_numeric' => true, 'type' => 'integer', 'min' => 0),
      array('name'=> 'offset', 'is_numeric' => true, 'type' => 'integer'),
      array('name'=> 'zip_code', 'is_numeric' => true, 'type' => 'integer', 'min' => 0, 'max' => 99999)
    ));

    $oC = new mCenters();
    $results = $oC->paginate_free_active_ads_by_zip($this->_qs['zip_code'], $this->_qs['limit'], $this->_qs['offset']);
    if($results === false)
      Response::json(array('data' => array()), 200);
    Response::json(array('data' => $results), 200);
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