<?php

class Base_Model {
    
    public function __construct() {
    }
    
    public static function getMenuCatalog($parent=0) {
        $result = dBShop::getListCategory($parent);
        
        return $result;
    }
    
    
    
    
    
    
    
    
    
    
    
}
