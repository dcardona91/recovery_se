<?php
namespace ThisApp\Models;

use \ThisApp\Aplication\System\DB;
use \ThisApp\Aplication\Security\ErrorLog;


class Example
{
	public $_data,
				 $_db;

	public function __construct()
	{
		$this->_db = DB::getInstance();
  }

  public function getAll(){
   $sql = "SELECT * FROM examples;";
    if ($this->_db->query($sql)->error() == true)
     ErrorLog::throwNew( $this->_db->errDesc(), debug_backtrace(), '500');
    return $this->_db->results();
  }
 
}