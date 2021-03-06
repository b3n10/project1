<?php
// uses singleton method

class DB {

	protected $_pdo;
	private static $_instance = null;

	public function __construct() {

		try {
			$this->_pdo = new PDO("pgsql:" . sprintf(
				"host=%s;port=%s;user=%s;password=%s;dbname=%s",
				Config::get('host'),
				Config::get('port'),
				Config::get('user'),
				Config::get('pass'),
				Config::get('dbname')
			));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (!self::$_instance) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function action($sql, $bindParams = array()) {
		$results_array = array();
		$stmt = $this->_pdo->prepare($sql);

		if (!empty($bindParams)) {
			foreach ($bindParams as $key => &$val) {
				$stmt->bindParam($key, $val);
			}
		}

		if ($stmt->execute()) {
			// INSERT, UPDATE, DELETE no need for results, so return true on success
			try {
				$fetch_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				return true;
			}

			// if mulitple or all sets of array are requested
			if (count($fetch_results) > 1) {
				return $fetch_results;
			}

			// if only 1 set of array is requested
			foreach ($fetch_results as $array) {
				foreach ($array as $key => $val) {
						$results_array += [$key => $val];
				}
			}

			// if try-catch didn't return true for INSERT, UPDATE, DELETE
			if (empty($results_array)) return true;

			return $results_array;
		}

		return false;
	}
}
