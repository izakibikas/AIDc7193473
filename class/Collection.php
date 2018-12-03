<?php

class Collection{

	private $array;
	private $counter;

	public function __construct(){
		if(!isset($_SESSION['collection'])){
			$this->array = array();
			$this->counter = 0;
		}
		else{
			$this->array = $_SESSION['collection'];
			$this->counter = count($_SESSION['collection']);
		}
	}

	public function getAll(){
		return $this->array;
	}

	public function add($value){
		$this->array[] = $value;
		$this->updateCounter;
		return $this->array;
	}

	public function updateCounter($direction='up'){
		if($direction=='up'){
			$this->counter++;
		}
		else{
			$this->counter--;
		}
		return $this->counter;
	}

}