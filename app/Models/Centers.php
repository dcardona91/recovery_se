<?php
namespace ThisApp\Models;

use \ThisApp\Aplication\System\DB;
use \ThisApp\Aplication\Security\ErrorLog;


class Centers
{
	public $_data,
				 $_db;

	public function __construct()
	{
		$this->_db = DB::getInstance();
  }

  public function paginate_all_free_active_ads($limit, $offset){
   $sql = "SELECT facility_name, address, phone_1 FROM ads WHERE active = 1 and level_id = 2 ORDER BY facility_name LIMIT {$offset} , {$limit};";
    if ($this->_db->query($sql)->error() == true)
      return false;
    return $this->_db->results();
  }

  public function paginate_free_active_ads_by_zip($zip, $limit, $offset){
   $sql = "SELECT
            a.*,
            c.name,
            s.full_name AS 'state',
            s.short_name AS 'state_code',
            c.name AS 'city_name'
            FROM ads a
            INNER JOIN cities c ON a.city_id = c.id 
            INNER JOIN states s ON a.state_id = s.id
            WHERE 
            (3958 * 3.1415926 * SQRT((a.lat - (SELECT CAST(z.lat AS DECIMAL(10,6) ) FROM zip_codes z WHERE zip = {$zip})) * (a.lat - (SELECT CAST(z.lat AS DECIMAL(10,6) ) FROM zip_codes z WHERE zip = {$zip})) + COS(a.lat / 57.29578) * COS(33.417187 / 57.29578) * (a.lon - (SELECT CAST(z.lon AS DECIMAL(10,6) ) FROM zip_codes z WHERE zip = {$zip})) * (a.lon - (SELECT CAST(z.lon AS DECIMAL(10,6) ) FROM zip_codes z WHERE zip = {$zip}))) / 180)  <= 200
            AND a.level_id = 2 AND a.active = 1 LIMIT {$offset} , {$limit};";
    if ($this->_db->query($sql)->error() == true)
      return false;
    return $this->_db->results();
  }
 
}