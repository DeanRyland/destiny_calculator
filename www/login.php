<?php
include_once('constant.php');
include_once("api.php");
include_once("util.php");
include_once("database.php");

include_once("classes/itemsClass.php");

$loginInfo = array("platform", "gamertag");

//Search Destiny Player URL array
$searchDestinyPlayerRequestData = array('SearchDestinyPlayer');

//Passing the array keys as data into the $loginData array
foreach ($_POST as $key => $value) {
	if(in_array($key, $loginInfo)) {
		$searchDestinyPlayerRequestData[$key] = $value;
	}
}

$gamertag = $searchDestinyPlayerRequestData['gamertag'];
$platform = $searchDestinyPlayerRequestData['platform'];

//Calling to get MembershipID from platform and gamertag
$curlMemIDReturn = curl($searchDestinyPlayerRequestData);

//Getting MembershipID
$memID = $curlMemIDReturn->Response[0]->membershipId;

//Get Account Summary URL array
$getAccountSummary = array($platform, "Account", $memID, "Summary");

//Calling to get Account Summary using MemID
$curlAccountSumReturn = curl($getAccountSummary);

$charactersArray = array(
	'platformType' => $platformToIcon[$curlAccountSumReturn->Response->data->membershipType],
	'gamerTag' => $gamertag,
	'characters' => array()
);


//Loop through Account Summary to grab Character Info
foreach($curlAccountSumReturn->Response->data->characters as $character){

	$characterArr = array();

	$characterArr['charLevel'] = $character->characterLevel;

	$characterArr['characterId'] = $character->characterBase->characterId;

	//Loop through CharacterID to grab Character Summary
	foreach($charactersArray['characters'] as &$characterArray){

		//Build Character Summary URL array
		$charSumRequestData = array($platform, 'Account', $memID, 'Character', $characterArray['characterId']);

		//Call Curl function to return Character Summary
		$charSumReturn = curl($charSumRequestData);

		//Get the equipment list from the character summary
		$equipmentList = $charSumReturn->Response->data->characterBase->peerView->equipment;

		//Used to store populated item info
		$items = array();

		//for equipment in my equipment list... get the item hash from bungie
		foreach($equipmentList as $equipment){

			//check equipment id in local database
			//if not existing
				//call bungie
				//get item
				//store in database

			//call the ItemInventory manifest for the inventory hash id
			$itemInfo = curl(array('Manifest', 'InventoryItem', $equipment->itemHash));

			//Add it to our item data holder
			//$items[$itemHashId] = $itemInfo;

			foreach($itemInfo as $item){
				//$charactersArray['items']["itemHash"] = $item->Response->data->inventoryItem->itemHash;
				if($tmpItem = new Item($item)){
					$items[] = json_encode(get_object_vars($tmpItem));
				}
			}
		}

		$charactersArray['items'] = $items;

		//$characterArray['items']['charPrimary'] = $character->items->['1']->Response->data->inventoryItem->
	}

		//manfiest /

	$characterArr['charlightLevel'] = $character->characterBase->powerLevel;

	$characterArr['charClass'] = $classHashesToString[$character->characterBase->classHash];

	$characterArr['charEmblem'] = $character->emblemPath;

	$characterArr['charBg'] = $character->backgroundPath;

	$charactersArray['characters'][] = $characterArr;
}

//$charSum = array('CharacterID'=>$characterID, 'CharacterLightLevel'=>$charlightLevel, 'CharacterClass'=>$charClass, 'CharacterEmblem'=>$charEmblem, 'CharacterBackground'=>$charBg);

print json_encode($charactersArray);
