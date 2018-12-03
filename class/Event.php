<?php

class Event {
	private $name, $location, $description, $dateTime;

	public function __construct($name,$location,$description,$dateTime){
		$this->name = $name;
		$this->location = $location;
		$this->description = $description;
		$this->dateTime = $dateTime;
	}

	public function setName($name){
		$this->name = $name;
	}
	public function setLocation($location){
		$this->location = $location;
	}
	public function setDescription($description){
		$this->description = $description;
	}
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}
	public function getName($name){
		return $this->name;
	}
	public function getLocation($location){
		return $this->location;
	}
	public function getDescription($description){
		return $this->description;
	}
	public function getDateTime($dateTime){
		return $this->dateTime;
	}
}