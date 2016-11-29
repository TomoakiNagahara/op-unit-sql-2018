<?php
/**
 * unit-sql:/sql.class.php
 *
 * @created   2016-11-28
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/**
 * sql
 *
 * @created   2016-11-29
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class sql extends OnePiece
{
	/**
	 * Database unit.
	 *
	 * @var db
	 */
	private $_db;

	/**
	 * Generate delete sql statement.
	 *
	 * @param  array $args
	 * @return string
	 */
	function Delete($args)
	{
		return delete::Get($args);
	}

	/**
	 * Generate insert sql statement.
	 *
	 * @param  array $args
	 * @return string
	 */
	function Insert($args)
	{
		return insert::Get($args);
	}

	/**
	 * Generate select sql statement.
	 *
	 * @param  array $args
	 * @return string
	 */
	function Select($args)
	{
		return select::Get($args, $this->_db);
	}

	/**
	 * Set database unit object.
	 *
	 * @param db $db
	 */
	function SetDatabase($db)
	{
		$this->_db = $db;
	}

	/**
	 * Generate update sql statement.
	 *
	 * @param  array $args
	 * @return string
	 */
	function Update($args)
	{
		return update::Get($args);
	}
}