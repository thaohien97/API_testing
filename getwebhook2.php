<?php


$entityBody = file_get_contents("php://input");
var_dump(json_decode($entityBody));