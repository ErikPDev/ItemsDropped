<?php

namespace ErikPDev\ItemsDropped\entity;

use pocketmine\entity\object\ItemEntity;


class Item extends ItemEntity{



    public function entityBaseTick(int $tickDiff = 1) : bool{
        try {
            if($this->closed){
                return false;
            }
            $hasUpdate = parent::entityBaseTick($tickDiff);
            
            // Custom Code
            $this->setNameTag("Hi!");
            $this->setNameTagVisible(true);
            $this->setNameTagAlwaysVisible(true);
            // PMMP CODE
            if(!$this->isFlaggedForDespawn() and $this->pickupDelay > -1 and $this->pickupDelay < 32767){ //Infinite delay
                $this->pickupDelay -= $tickDiff;
                if($this->pickupDelay < 0){
                    $this->pickupDelay = 0;
                }
    
                $this->age += $tickDiff;
                if($this->age > 6000){
                    $ev = new ItemDespawnEvent($this);
                    $ev->call();
                    if($ev->isCancelled()){
                        $this->age = 0;
                    }else{
                        $this->flagForDespawn();
                        $hasUpdate = true;
                    }
                }
            }
    
            return $hasUpdate;
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
        
    }
}