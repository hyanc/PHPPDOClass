<?php
	class SQL {
		protected $db = array(
			'rdbms' => 'mysql',
			'host' => '127.0.0.1',
			'port' => 3306,
			'username' => 'dbUser',
			'password' => 'dbPass',
			'name' => 'dbName'
		);
		var $link;
		function __construct() {
			try {
				$this->link = new PDO(
					$this->db['rdbms'].":host=".$this->db['host'].";dbname=".$this->db['name'].";port=".$this->db['port'],
					$this->db['username'],
					$this->db['password']
				);
				$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e) {
				echo $e->getMessage(); exit;
			}
		}
		public function query($sql, $row = false) {
			$res = Array();
			$res['count'] = 0;
			try {
				$exec = $this->link->query($sql);
				$res['sql'] = $sql;
				$res['count'] = $exec->rowCount();
				if(substr(preg_replace("/\PL/u",'',strtolower(trim($sql))),0,6)=="select") {
					$res['cols'] = Array();
					if($exec->columnCount() > 0) {
						foreach(range(0, $exec->columnCount() - 1) as $columns) {
							$meta = $exec->getColumnMeta($columns);
							$res['cols'][] = $meta['name'];
						}
					}
					$res['match'] = $exec->fetchAll(PDO::FETCH_ASSOC);
					if(is_numeric($row)) return $res['match'][$row][$res['cols'][0]];
				}
			}
			catch(PDOException $e) {
				$res['error'] = $e->getMessage();
			}
			return $res;
		}
	}
?>
