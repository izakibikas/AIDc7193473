<?php

class DBFunctions{

	private $mysqli;

	public function __construct($mysqli){
		$this->mysqli = $mysqli;
	}

	public function select($tableName,$columns='*',$whereClause='',$order='',$limit=''){
		$result = $this->mysqli->query("select $columns from $tableName $whereClause $order $limit");
		$data = [];
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}

	public function insert($tableName,$columns,$values){
		$query  =  "insert into ".$tableName."($columns) values($values)";
		return $this->mysqli->query($query);
	}

	public function update($tableName,$values,$whereClause){
		$query = "update $tableName set $values $whereClause";
		return $this->mysqli->query($query);
	}

	public function delete($tableName,$whereClause){
		$query = "delete from $tableName $whereClause";
		return $this->mysqli->query($query);
	}
}