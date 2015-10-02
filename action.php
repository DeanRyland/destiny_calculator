<?php

$fields = array("primary", "special", "heavy", "ghost", "helmet", "gauntlets", "chest", "legs", "classItem", "artifact");

$data = array("errors"=>array(), "charLimit"=>array(), "numChar"=>array(), 'negVal'=>array());

//Check if required fields are populated and correct
$required_fields = array("primary", "special", "heavy", "ghost", "helmet", "gauntlets", "chest", "legs", "classItem", "artifact");

foreach($_POST as $key => $value) {
	if (empty($value) && in_array($key, $required_fields)) {
		$data["errors"][] = $key;
	}
	if (strlen($value) > 3) {
		$data["charLimit"][] = $key;
	}
	if (!is_numeric($value)) {
		$data["numChar"][] = $key;
	}
	if ($value < 1 || $value > 999) {
		$data["negVal"][] = $key;
	}
}

//Check for empty Post or Non empty error arrays
if (	
	empty($_POST) ||
	!empty($data['errors'])
	) {	
	print json_encode($data);
	exit;
}

if (
	!empty($data['charLimit'])
	) {
	print json_encode($data);
	exit;
}

if (
	!empty($data['numChar'])
	) {
	print json_encode($data);
	exit;
}

if (
	!empty($data['negVal'])
	) {
	print json_encode($data);
	exit;
}

//Passing the array keys as data into the $data array
foreach ($_POST as $key => $value) {
	if(in_array($key, $fields)) {
		$data[$key] = $value;
	}
}

//Getting data from $data array and building the $lightLevel to be passed through to the script as JSON
$weapons = array($data["primary"], $data["special"], $data["heavy"]);
$weaponSum = array_sum($weapons);
$weaponLightLevel = ($weaponSum / 3) * 0.36;

$armour = array($data["helmet"], $data["gauntlets"], $data["chest"], $data["legs"]);
$armourSum = array_sum($armour);
$armourLightLevel = ($armourSum / 4) * 0.4;

$misc = array($data["ghost"], $data["classItem"], $data["artifact"]);
$miscSum = array_sum($misc);
$miscLightLevel = ($miscSum / 2) * 0.16;

$lightLevel = $weaponLightLevel + $armourLightLevel + $miscLightLevel;

$data["light_level"] = floor($lightLevel);

print json_encode($data);
