<?php

class dBShop extends dB {

	public function __construct() {
		//parent::init();
	}

	
    // *****************************
    //       Таблица Catalog
    // *****************************
    
	public static function searchForCatalog($search) {
		$result = false;
		if($search) {
			$query = self::$database->prepare("SELECT id,title FROM ".PREFIX."catalog_cats WHERE (locate(:search, `content`)>0)");
			$query->execute(array( ':search'  => $search ));
			$result = $query->fetchAll();
		}
		 
		return $result;
	}
	    
    public static function getAllCatsForTree($parent) {
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title,is_parent FROM ".PREFIX."catalog_cats WHERE parent = :parent ORDER BY `id` ASC");
    	$query->execute(array(
    			':parent'  => $parent
    			));
    	$result = $query->fetchAll();
    	
    	return $result;    	
    }

    public static function uncheckIsParentCat($id) {
		$result = false;
		if($id) {
			$query = self::$database->prepare("UPDATE ".PREFIX."catalog_cats SET is_parent=0 WHERE id=:id");
			$result = $query->execute(array(
					':id'  => $id
			));
		}
		
		return $result;
	}

	public static function checkIsParentCat($id) {
		$result = false;
		if($id) {
			$query = self::$database->prepare("UPDATE ".PREFIX."catalog_cats SET is_parent=1 WHERE id=:id");
			$result = $query->execute(array(
					':id'  => $id
			));
		}
		
		return $result;
	}
	
	public static function countParentCat($parent) {
		$count = false;
		if($parent) {
			$query = self::$database->prepare("SELECT COUNT(*) as count FROM ".PREFIX."catalog_cats WHERE parent = :parent");
			$query->execute(array(':parent' => $parent));
			$row = $query->fetch();
			$count = $row['count'];
			
		}
		
		return $count;
	}
	
	public static function deleteCat($id) {
		$result = false;
		if($id) {
			$query = self::$database->prepare("DELETE FROM ".PREFIX."catalog_cats WHERE id=:id");
			$result = $query->execute(array(
					':id'  => $id
			));
		}
		
		return $result;
	}
	
	public static function findParentCat($id) {
		$result = false;
		if($id) {
			$query = self::$database->prepare("SELECT parent FROM ".PREFIX."catalog_cats WHERE id = :id");
			$query->execute(array(':id' => $id));
			$result = $query->fetch();
			$result = $result['parent'];
		}
		
		return $result;
	}
	
	public static function deleteParentCats($parent) {
		$result = false;		
		if($parent) {
			$query = self::$database->prepare("DELETE FROM ".PREFIX."catalog_cats WHERE parent = :parent");
			$result = $query->execute(array( ':parent'  => $parent ));
		}
		 
		return $result;
	}
	
	public static function updateCat($data) {
		$result = false;
		if($data) {
			$query = self::$database->prepare("UPDATE ".PREFIX."catalog_cats SET title=:title, url=:url, content=:content, parent=:parent, active=:active WHERE id=:id");
			$result = $query->execute(array(
					':id'  => $data['id'],
					':title'  => $data['title'],
					':url'  => $data['url'],
					':content'  => $data['content'],
					':parent'  => $data['parent'],
					':active'  => $data['active'] ));
		}
		 
		return $result;
	}
	
	public static function newCat($data) {
		$result = false;
		if($data) {
			$query = self::$database->prepare("INSERT ".PREFIX."catalog_cats (id, title, url, content, picture, parent, is_parent, active) VALUES (:id, :title, :url, :content, :picture, :parent, :is_parent, :active)");
			$result = $query->execute(array(
					':id'  => '',
					':title'  => $data['title'],
					':url'  => $data['url'],
					':content'  => $data['content'],
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
    		$query = self::$database->prepare("SELECT id,title,content,active FROM ".PREFIX."catalog_cats WHERE url = :url");
    		$query->execute(array('url' => $url));
    		$result = $query->fetch();
    	}
    	
    	return $result;
    }
    
    public static function getContentCatById($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT id,url,active,content,title,parent FROM ".PREFIX."catalog_cats WHERE id = :id");
    		$query->execute(array(':id' => $id));
    		$result = $query->fetch();
    	}
    
    	return $result;
    }

    public static function getListCategory($parent=0) {    	
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title,url,active FROM ".PREFIX."catalog_cats WHERE parent = :parent");
    	$query->execute(array(':parent' => $parent));
    	$result = $query->fetchAll();
    	 
    	return $result;
    }
    
    public static function getTitleCategory($id) {
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title FROM ".PREFIX."catalog_cats WHERE id = :id");
    	$query->execute(array(':id' => $id));
    	$result = $query->fetch();
    
    	return $result;
    }
    
    
    // *****************************
    //       Таблица Items
    // *****************************
    
    public static function getAllItems($category) {
    	$result = false;
    	
    	if($category == 0) {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."catalog_items ORDER BY `id` ASC");
    		$query->execute(array());
    	} else {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."catalog_items WHERE category = :category ORDER BY `id` ASC");
    		$query->execute(array(
    			':category'  => $category
    		));
    	}
    	$result = $query->fetchAll();
    	 
    	return $result;
    }
    
    public static function getContentItem($url) {
    	$result = false;
    	if($url) {
    		$query = self::$database->prepare("SELECT id,title,content FROM ".PREFIX."catalog_items WHERE url = :url");
    		$query->execute(array('url' => $url));
    		$result = $query->fetch();
    	}
    	
    	return $result;
    }

    public static function getItemById($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."catalog_items WHERE id = :id");
    		$query->execute(array('id' => $id));
    		$result = $query->fetch();
    	}
    	 
    	return $result;
    }

    public static function getItemByTitle($title) {
    	$result = false;
    	if($title) {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."catalog_items WHERE title = :title");
    		$query->execute(array('title' => $title));
    		$result = $query->fetch();
    	}
    
    	return $result;
    }
    
    public static function updateItem($data) {
    	$result = false;
    	if($data) {
    		$query = self::$database->prepare("UPDATE ".PREFIX."catalog_items SET url=:url, category=:category, title=:title, content=:content, pic_url=:pic_url, price=:price, price_zakup=:price_zakup, quantity=:quantity, weight=:weight, lenght=:lenght, prop=:prop, active=:active, country=:country WHERE id=:id");
    		$result = $query->execute(array(
    				':id'  => $data['id'],
    				':url'  => $data['url'],
    				':category'  => $data['category'],
    				':title'  => $data['title'],
    				':content'  => $data['content'],
    				':pic_url'  => $data['pic_url'],
    				':price'  => $data['price'],
    				':price_zakup'  => $data['price_zakup'],
    				':quantity'  => $data['quantity'],
    				':weight'  => $data['weight'],
    				':lenght'  => $data['lenght'],
    				':prop'  => $data['prop'],
    				':active'  => $data['active'],
    				':country'  => $data['country']
    				 ));
    	}
    		
    	return $result;
    }
    
    public static function newItem($data) {
    	$result = false;
    	if($data) {
    		$query = self::$database->prepare("INSERT ".PREFIX."catalog_items (id, url, category, title, content, pic_url, price, price_zakup, quantity, weight, lenght, prop, active, country) VALUES (:id, :url, :category, :title, :content, :pic_url, :price, :price_zakup, :quantity, :weight, :lenght, :prop, :active, :country)");
    		$result = $query->execute(array(
    				':id'  => '',
    				':url'  => $data['url'],
    				':category'  => $data['category'],
    				':title'  => $data['title'],
    				':content'  => $data['content'],
    				':pic_url'  => $data['pic_url'],
    				':price'  => $data['price'],
    				':price_zakup'  => $data['price_zakup'],
    				':quantity'  => $data['quantity'],
    				':weight'  => $data['weight'],
    				':lenght'  => $data['lenght'],
    				':prop'  => $data['prop'],
    				':active'  => $data['active'],
    				':country'  => $data['country']
    		));
    	}
    		
    	return $result;
    }
    
    public static function deleteItem($id) {
    	$result = false;
    	
    	if($id) {
    		$query = self::$database->prepare("DELETE FROM ".PREFIX."catalog_items WHERE id=:id");
    		$result = $query->execute(array(
    				':id'  => $id
    		));
    	}
    	
    	return $result;
    }
    
    public static function deletePicture($id) {
    	$result = false;
    	
    	$query = self::$database->prepare("UPDATE ".PREFIX."catalog_items SET pic_url='' WHERE id=:id");
    	$result = $query->execute(array(
    			':id'  => $id ));
    	if($result) {
    		$edit_item = self::getItemById($id);
    		unlink(Engine::$settings['main_host'].Engine::$settings['directory_pictures'].'/'.$edit_item['pic_url']);
    	}
    	 
    	return $result;
    }
    


    // *****************************
    //       Таблица Country
    // *****************************
    
    
    public static function getAllCountries() {
    	$result = false;
    	 
    	$query = self::$database->prepare("SELECT * FROM ".PREFIX."country ORDER BY `id` ASC");
    	$query->execute(array());
    	$result = $query->fetchAll();
    
    	return $result;
    }
    
    public static function getCountryById($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."country WHERE id = :id");
    		$query->execute(array('id' => $id));
    		$result = $query->fetch();
    	}
    
    	return $result;
    }
    
    
}