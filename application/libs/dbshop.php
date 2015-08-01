<?php

class dBShop extends dB {

    public function __construct() {
        parent::__construct();
    }

	
    // *****************************
    //       Таблица Categories
    // *****************************
    
    public static function searchForCatalog($search) {
	$result = false;
	if($search) {
            $query = self::$database->prepare("SELECT id,title FROM ".PREFIX."items_categories WHERE (locate(:search, `description`)>0)");
            $query->execute(array( ':search'  => $search ));
            $result = $query->fetchAll();
	}
		 
	return $result;
    }
	    
    public static function getAllCatsForTree($parent) {
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title,is_parent FROM ".PREFIX."items_categories WHERE parent = :parent ORDER BY `id` ASC");
    	$query->execute(array(
    			':parent'  => $parent
    			));
    	$result = $query->fetchAll();
    	return $result;    	
    }

    public static function uncheckIsParentCat($id) {
	$result = false;
	if($id) {
            $query = self::$database->prepare("UPDATE ".PREFIX."items_categories SET is_parent=0 WHERE id=:id");
            $result = $query->execute(array(
				':id'  => $id
                                ));
	}		
	return $result;
    }

    public static function checkIsParentCat($id) {
	$result = false;
	if($id) {
            $query = self::$database->prepare("UPDATE ".PREFIX."items_categories SET is_parent=1 WHERE id=:id");
            $result = $query->execute(array(
				':id'  => $id
                                ));
	}
	return $result;
    }
	
    public static function countParentCat($parent) {
	$count = false;
	if($parent) {
            $query = self::$database->prepare("SELECT COUNT(*) as count FROM ".PREFIX."items_categories WHERE parent = :parent");
            $query->execute(array(':parent' => $parent));
            $row = $query->fetch();
            $count = $row['count'];
	}
	return $count;
    }
	
    public static function deleteCat($id) {
	$result = false;
	if($id) {
            $query = self::$database->prepare("DELETE FROM ".PREFIX."items_categories WHERE id=:id");
            $result = $query->execute(array(
				':id'  => $id
                                ));
	}
	return $result;
    }
	
    public static function findParentCat($id) {
	$result = false;
	if($id) {
            $query = self::$database->prepare("SELECT parent FROM ".PREFIX."items_categories WHERE id = :id");
            $query->execute(array(':id' => $id));
            $result = $query->fetch();
            $result = $result['parent'];
	}
	return $result;
    }
	
    public static function deleteParentCats($parent) {
	$result = false;		
	if($parent) {
            $query = self::$database->prepare("DELETE FROM ".PREFIX."items_categories WHERE parent = :parent");
            $result = $query->execute(array( ':parent'  => $parent ));
	}
	return $result;
    }
	
    public static function updateCat($data) {
	$result = false;
	if($data) {
            $query = self::$database->prepare("UPDATE ".PREFIX."items_categories SET title=:title, url=:url, description=:description, parent=:parent, active=:active WHERE id=:id");
            $result = $query->execute(array(
				':id'  => $data['id'],
				':title'  => $data['title'],
				':url'  => $data['url'],
				':description'  => $data['content'],
				':parent'  => $data['parent'],
				':active'  => $data['active'] ));
	}
	return $result;
    }
	
    public static function newCat($data) {
	$result = false;
	if($data) {
            $query = self::$database->prepare("INSERT ".PREFIX."items_categories (id, title, url, description, picture, parent, is_parent, active) VALUES (:id, :title, :url, :description, :picture, :parent, :is_parent, :active)");
            $result = $query->execute(array(
				':id'  => '',
				':title'  => $data['title'],
				':url'  => $data['url'],
				':description'  => $data['content'],
				':picture'  => '',
				':parent'  => $data['parent'],
				':is_parent'  => 0,
				':active'  => $data['active'] ));
	}
	return $result;
    }
	
    public static function getContentCatalog($url) {
    	$result = false;
    	if($url) {
            $query = self::$database->prepare("SELECT id,title,description,active FROM ".PREFIX."items_categories WHERE `url` = :url");
            $query->execute(array('url' => $url));
            $result = $query->fetch();
    	}
    	return $result;
    }
    
    public static function getContentCatById($id) {
    	$result = false;
    	if($id) {
            $query = self::$database->prepare("SELECT id,url,active,description,title,parent FROM ".PREFIX."items_categories WHERE `id` = :id");
            $query->execute(array(':id' => $id));
            $result = $query->fetch();
    	}
    	return $result;
    }

    public static function getListCategory($parent=0) {    	
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title,url,active FROM ".PREFIX."items_categories WHERE `parent` = :parent");
    	$query->execute(array(':parent' => $parent));
    	$result = $query->fetchAll();
    	return $result;
    }
    
    public static function getTitleCategory($id) {
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title FROM ".PREFIX."items_categories WHERE `id` = :id");
    	$query->execute(array(':id' => $id));
    	$result = $query->fetch();
    	return $result;
    }
    
    
    // *****************************
    //       Таблица Items
    // *****************************
    
    public static function getRecomendedItems($kolvo){
    	$result = false;
        $query = self::$database->prepare("SELECT `url`,`pic_url`,`title` FROM ".PREFIX."items WHERE `favorite` = 1 ORDER BY `id` ASC LIMIT 0, ".$kolvo);
        $query->execute(array());
    	$result = $query->fetchAll();
    	return $result;
    }
    
    public static function getNewItems($kolvo){
    	$result = false;
        $query = self::$database->prepare("SELECT `url`,`pic_url`,`title`,`annotation`,`price`,`old_price` FROM ".PREFIX."items WHERE `new` = 1 ORDER BY `id` ASC LIMIT 0, ".$kolvo);
        $query->execute(array());
    	$result = $query->fetchAll();
    	return $result;
    }
    
    public static function getAllItems($category) {
    	$result = false;
    	if($category == 0) {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items ORDER BY `id` ASC");
            $query->execute(array());
    	} else {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items WHERE `id_cat` = :id_cat ORDER BY `id` ASC");
            $query->execute(array(
    			':id_cat'  => $category
                        ));
    	}
    	$result = $query->fetchAll();
    	return $result;
    }
    
    public static function getContentItem($url) {
    	$result = false;
    	if($url) {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items WHERE `url` = :url");
            $query->execute(array('url' => $url));
            $result = $query->fetch();
    	}
    	return $result;
    }

    public static function getItemById($id) {
    	$result = false;
    	if($id) {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items WHERE id = :id");
            $query->execute(array('id' => $id));
            $result = $query->fetch();
    	}
    	return $result;
    }

    public static function getItemByTitle($title) {
    	$result = false;
    	if($title) {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items WHERE title = :title");
            $query->execute(array('title' => $title));
            $result = $query->fetch();
    	}
    	return $result;
    }
    
    public static function updateItem($data) {
    	$result = false;
    	if($data) {
            $query = self::$database->prepare("UPDATE ".PREFIX."items SET url=:url, id_cat=:id_cat, title=:title, price=:price, old_price=:old_price, weight=:weight, annotation=:annotation, description=:description, pic_url=:pic_url, active=:active, props=:props, new=:new, favorite=:favorite WHERE id=:id");
            $result = $query->execute(array(
                                ':id'  => $data['id'],
    				':url'  => $data['url'],
    				':id_cat'  => $data['category'],
    				':title'  => $data['title'],
    				':price'  => $data['price'],
    				':old_price'  => $data['old_price'],
    				':weight'  => $data['weight'],
    				':annotation'  => $data['annotation'],
    				':description'  => $data['description'],
    				':pic_url'  => $data['pic_url'],
    				':active'  => $data['active'],
    				':props'  => $data['props'],
    				':new'  => $data['new'],
    				':favorite'  => $data['favorite']
    				 ));
    	}
    	return $result;
    }
    
    public static function newItem($data) {
    	$result = false;
    	if($data) {
            $query = self::$database->prepare("INSERT ".PREFIX."items (id, url, id_cat, title, price, old_price, weight, annotation, description, pic_url, active, props, new, favorite) VALUES (:id, :url, :id_cat, :title, :price, :old_price, :weight, :annotation, :description, :pic_url, :active, :props, :new, :favorite)");
            $result = $query->execute(array(
    				':id'  => '',
    				':url'  => $data['url'],
    				':id_cat'  => $data['category'],
    				':title'  => $data['title'],
    				':price'  => $data['price'],
    				':old_price'  => $data['old_price'],
    				':weight'  => $data['weight'],
    				':annotation'  => $data['annotation'],
    				':description'  => $data['description'],
    				':pic_url'  => $data['pic_url'],
    				':active'  => $data['active'],
    				':props'  => $data['props'],
    				':new'  => $data['new'],
    				':favorite'  => $data['favorite']
                                ));
    	}
        $result = self::$database->lastInsertId();
    	return $result;
    }
    
    public static function deleteItem($id) {
    	$result = false;
    	if($id) {
            $query = self::$database->prepare("DELETE FROM ".PREFIX."items WHERE id=:id");
            $result = $query->execute(array(
    				':id'  => $id
                                ));
    	}
    	return $result;
    }
    
    public static function deletePicture($id) {
    	$result = false;
    	$query = self::$database->prepare("UPDATE ".PREFIX."items SET pic_url='' WHERE id=:id");
    	$result = $query->execute(array(
                                ':id'  => $id ));
    	if($result) {
            $edit_item = self::getItemById($id);
            unlink(Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$edit_item['pic_url']);
    	}
    	return $result;
    }
    


    // *****************************
    //       Таблица Skus
    // *****************************
    
    public static function getVariantsByItem($item) {
    	$result = false;
    	if($item) {
            $query = self::$database->prepare("SELECT * FROM ".PREFIX."items_skus WHERE id_item = :id_item");
            $query->execute(array('id_item' => $item));
            $result = $query->fetchAll();
    	}
    	return $result;
    }

    public static function updateVariant($data) {
    	$result = false;
    	if($data) {
            for($i=0;$i<count($data['price']);$i++) {
            $query = self::$database->prepare("UPDATE ".PREFIX."items_skus SET id_item=:id_item, articul=:articul, price=:price, old_price=:old_price, weight=:weight, quantity=:quantity, pic_url=:pic_url, skus=:skus WHERE id=:id");
            $result = $query->execute(array(
                                ':id'  => $data['id'][$i],
    				':id_item'  => $data['id_item'][$i],
    				':articul'  => $data['articul'][$i],
    				':price'  => $data['price'][$i],
    				':old_price'  => $data['old_price'][$i],
    				':weight'  => $data['weight'][$i],
    				':quantity'  => $data['quantity'][$i],
    				':pic_url'  => $data['pic_url'][$i],
                                ':skus'  => $data['skus'][$i]
    				 ));
            }
    	}
    	return $result;
    }
    
    public static function newVariant($data, $id_item) {
    	$result = false;
    	if($data) {
            for($i=0;$i<count($data['price']);$i++) {
            $query = self::$database->prepare("INSERT ".PREFIX."items_skus (id, id_item, articul, price, old_price, weight, quantity, pic_url, skus) VALUES (:id, :id_item, :articul, :price, :old_price, :weight, :quantity, :pic_url, :skus)");
            $result = $query->execute(array(
    				':id'  => '',
    				':id_item'  => $id_item,
    				':articul'  => $data['articul'][$i],
    				':price'  => $data['price'][$i],
    				':old_price'  => $data['old_price'][$i],
    				':weight'  => $data['weight'][$i],
    				':quantity'  => $data['quantity'][$i],
    				':pic_url'  => $data['pic_url'][$i],
                                ':skus'  => $data['skus'][$i]
                                ));
            }
    	}
    	return $result;
    }
    
    public static function deleteVariantByItem($id) {
    	$result = false;
    	if($id) {
            $query = self::$database->prepare("DELETE FROM ".PREFIX."items_skus WHERE id_item=:id");
            $result = $query->execute(array(
    				':id'  => $id
                                ));
    	}
    	return $result;
    }

    public static function deleteVariant($id) {
    	$result = false;
    	if($id) {
            $query = self::$database->prepare("DELETE FROM ".PREFIX."items_skus WHERE id=:id");
            $result = $query->execute(array(
    				':id'  => $id
                                ));
    	}
    	return $result;

    }
    
    public static function deletePicVariant($id) {
    	$result = false;
    	$query = self::$database->prepare("UPDATE ".PREFIX."items_skus SET pic_url='' WHERE id=:id");
    	$result = $query->execute(array(
                                ':id'  => $id ));
    	if($result) {
            $edit_item = self::getItemById($id);
            unlink(Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$edit_item['pic_url']);
    	}
    	return $result;
    }
    

    

    // *****************************
    //       Таблица Cat_props
    // *****************************
    
 
    public static function getCatProps($category) {
    	$result = false;
    	$query = self::$database->prepare("SELECT `pid` FROM ".PREFIX."items_cat_props WHERE `id_cat`=".$category);
    	$query->execute(array());
    	$result = $query->fetchAll();
    	return $result;
    }

    
    
    // *****************************
    //       Таблица Prop_names
    // *****************************
    
 
    public static function getPropName($pid) {
    	$result = false;
    	$query = self::$database->prepare("SELECT `name` FROM ".PREFIX."items_prop_names WHERE `id`=".$pid);
    	$query->execute(array());
    	$result = $query->fetch();
    	return $result['name'];
    }
    
    
    // *****************************
    //       Таблица Prop_values
    // *****************************
    
 
    public static function getPropValues($pid) {
    	$result = false;
    	$query = self::$database->prepare("SELECT `id`,`name` FROM ".PREFIX."items_prop_values WHERE `pid`=".$pid);
    	$query->execute(array());
    	$result = $query->fetchAll();
    	return $result;
    }

    
    
    
    
    
    
}