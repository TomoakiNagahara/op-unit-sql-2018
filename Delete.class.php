<?php
/**
 * unit-sql:/Delete.class.php
 *
 * @created   2016-12-01
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace SQL;

/** Delete
 *
 * @created   2016-12-01
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Delete
{
	/** trait
	 *
	 */
	use \OP_CORE;

	/** Get delete sql statement.
	 *
	 * @param  array
	 * @param  db
	 * @return string
	 */
	static function Get($args, $db=null)
	{
		//	...
		if(!$db){
			\Notice::Set("Has not been set database object.");
			return false;
		}

		//	TABLE
		if(!$table = DML::table($args, $db) ){
			return false;
		}

		//	WHERE
		if(!$where = DML::where($args, $db) ){
			return false;
		}

		//	LIMIT
		if(!$limit = DML::limit($args, $db)){
			return false;
		}

		return "DELETE FROM {$table} WHERE {$where} LIMIT {$limit}";
	}
}