<?php

function __autoload($class){
	include(PUBLIC_PATH.'/class/'.$class.'.php');
}