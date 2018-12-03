<?php

session_start();

require('class/Event.php');
require('class/Collection.php');

$collection = new Collection();

$event = new Event('Live Concert','Tundikhel, Kathmandu','Live concert for free in Tundikhel. Also get a free hat.','2018-04-06 12:00:00');

$collection->add($event);

?>