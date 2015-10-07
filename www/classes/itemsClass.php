<?php

// base class with member properties and methods
class Item {

   public $itemHash;
   public $itemName;
   public $itemDescription;
   public $tierTypeName;
   public $itemIcon;

   function Item($rawItemObj) 
   {  
      if(empty($rawItemObj->data->inventoryItem->itemHash)){
          return false;
      }
      
      $this->itemHash =         $rawItemObj->data->inventoryItem->itemHash;
      $this->itemName =         empty($rawItemObj->data->inventoryItem->itemName) ? $rawItemObj->data->inventoryItem->itemName : "No name";
      $this->tierTypeName =     empty($rawItemObj->data->inventoryItem->tierTypeName) ? $rawItemObj->data->inventoryItem->tierTypeName : "";
      $this->itemIcon =         empty($rawItemObj->data->inventoryItem->icon) ? $rawItemObj->data->inventoryItem->icon : "no-icon.jpg"; 

      return true;       
   }

} // end of class Item