<?php
include 'config.php';

class Db {

	static $con = false;
	
	function __construct() {
	}


 	/**
	 * getCon()
	 *
	 * Inicializa uma conexão com o banco (Singleton)
	 *
	 * @example
	 * PostgreSQL pgsql:host=localhost;dbname=intranetanalise
	 * Oracle     OCI:dbname=intranetanalise
	 * MySQL      mysql:host=localhost;dbname=intranetanalise
	 * @version 1.0 16/02/2009 13:32
	 * @return PDO
	 */
	public static function getCon() {

		if (!self::$con) {
			try {

				$db_host = host;
				$db_type = type;
				$db_port = port;
				$db_database = database;
				$db_username = username;
				$db_password = password;
				$db_persistent = true;

				$dsn = $db_type . ':';
				$dsn .= 'dbname=' . $db_database . '';
				$dsn .= $db_host ? ';host=' . $db_host : '';
				$dsn .= $db_port ? ';port=' . $db_port : '';

				self::$con = new PDO($dsn, $db_username, $db_password);
				self::$con->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
				self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$con->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
				if ($db_persistent) {
					self::$con->setAttribute(PDO::ATTR_PERSISTENT, true);
				}
			} catch (PDOException $oException) {
				echo 'Erro de coneccao';
				echo '<pre>';
				var_dump($oException);
			}
		}
		return self::$con;
	}

	/**
	 * query()
	 *
	 * Executa uma query SELECT recebendo ou não bind variables
	 *
	 * @link http://br.php.net/manual/pt_BR/class.pdostatement.php
	 * @param string $sql
	 * @param array $aBindVar
	 * @version 1.0 16/02/2009 13:32
	 * @return PDOStatement
	 */
	public static function query($sql, $aBindVar = null) {

		$stm = null;
		if (self::getCon()) {
			$con = self::getCon();
			try {
				if ($aBindVar == null) {
					$stm = $con->query($sql);
					$con = false;
				} else {
					$stm = $con->prepare($sql);
					$stm->execute($aBindVar);
					$con = false;
				}
				$stm->setFetchMode(PDO::FETCH_ASSOC);
			} catch (PDOException $oException) {			
				echo "<pre>";
				var_dump( $oException);
				echo "</pre>";
				return $oException;
			}
		}
		return $stm;
	}

	/**
	 * exec()
	 *
	 * Executa uma query DELETE, UPDATE ou INSERT
	 *
	 * @link http://br.php.net/manual/pt_BR/pdo.exec.php
	 * @param string $sql
	 * @version 1.0 16/02/2009 13:32
	 * @return integer
	 */
	public static function exec($sql, $aBindVar = null) {
		$iNrows = 0;

		if (self::getCon()) {
			$con = self::getCon();
			try {
				if ($aBindVar == null) {
					$iNrows = $con->exec($sql);
					$con = false;
				} else {
					$stm = $con->prepare($sql);
					$stm->execute($aBindVar);
					$iNrows = $stm->rowCount();
					$stm = NULL;
				}
			} catch (PDOException $oException) {
				$con = false;
				return $oException;
			}
		}
		return $iNrows;
	}

	public static function exec2($sql, $aBindVar = null,$tabela = false) {

		$iNrows = 0;

		if ($tabela) {
			$lid = 'SELECT MAX('.$tabela['id'].') id FROM '.$tabela['nome'];
		}

		if (self::getCon()) {
			$con = self::getCon();
			try {
				
				if ($aBindVar == null) {
					$iNrows = $con->exec($sql);
				} else {
					$stm = $con->prepare($sql);
					$stm->execute($aBindVar);
				}

				if ($tabela) {
					$stm = $con->query($lid);
					$id = $stm->fetch();
					return $id['id'];
				}

			} catch (PDOException $oException) {
				$con = false;
				return $oException;
			}
		}

		return $con->lastInsertId();
	}

	public static function lastInsertId() {
		$con = self::getCon();
		return $con->lastInsertId();
	}

	private function __clone() {
	}

 
}
?>