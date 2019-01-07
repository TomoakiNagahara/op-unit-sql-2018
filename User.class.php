<?php
/**
 * unit-sql:/User.class.php
 *
 * @created   2017-12-19
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2017-12-19
 */
namespace OP\UNIT\SQL;

/** User
 *
 * @created   2017-12-19
 * @version   1.0
 * @package   unit-sql
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class User
{
	/** trait
	 *
	 */
	use \OP_CORE;

	/** Create user
	 *
	 * @param	 array		 $config
	 * @param	\IF_DATABASE $DB
	 * @return	 boolean|string
	 */
	static function Create($config, $DB)
	{
		//	...
		$host = ifset($config['host']);
		$user = ifset($config['user']);

		//	...
		if( !$host or !$user ){
			\Notice::Set("Has not been set host name or user name. ($host, $user)");
			return false;
		}

		//	...
		if( strlen($user) > 16 ){
			\Notice::Set("User name is too long. (Maximum 16 character: $user)");
			return false;
		}

		//	...
		$host = $DB->PDO()->Quote($host);
		$user = $DB->PDO()->Quote($user);

		//	...
		if( $password = ifset($config['password']) ){
			$identified = "BY " . $DB->PDO()->Quote($password);
		}else{
			$identified = 'WITH mysql_native_password';
		}

		//	...
		switch( $DB->Config()['prod'] ){
			case 'mysql':
				//      CREATE USER  'user'@'host'  IDENTIFIED WITH mysql_native_password;
				return "CREATE USER {$user}@{$host} IDENTIFIED $identified";

			case 'pgsql':
				//	...
				if( strpos($password, "'") !== false ){
					throw new \Exception("Password has single quote character.");
				};
				//      CREATE ROLE   user  WITH LOGIN PASSWORD '  password ';
				return "CREATE ROLE {$user} WITH LOGIN PASSWORD '{$password}'";
				break;
		};
	}

	/** Set password
	 *
	 * @param	 array		 $config
	 * @param	\IF_DATABASE $DB
	 * @return	 boolean|string
	 */
	static function Password($config, $DB)
	{
		//	...
		$host = ifset($config['host']);
		$user = ifset($config['user']);
		$password = ifset($config['password']);

		//	...
		if( !$host or !$user or !$password ){
			\Notice::Set("Has not been set host name or user name or password. ($host, $user, $password)");
			return false;
		}

		//	...
		$host	 = $DB->PDO()->Quote($host);
		$user	 = $DB->PDO()->Quote($user);
		$password= $DB->PDO()->Quote($password);

		//		SET PASSWORD FOR  'user'@'host'  = '***';
		return "SET PASSWORD FOR {$user}@{$host} = PASSWORD({$password})";
	}
}
