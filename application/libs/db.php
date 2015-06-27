<?php

class dB {
    protected static $host   = HOST;
    protected static $dbname = NAME_BD;
    protected static $user   = USER;
    protected static $pass   = PASSWORD;
    protected static $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected static $database;
 
 
    public function __construct() {
		
    }
    
    public static function init() {
    	
    	try {
    		self::$database = new PDO('mysql:host='. self::$host .';dbname='. self::$dbname,
    				self::$user,
    				self::$pass,
    				self::$options
    		);
    		self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}
    	catch(PDOException $e) {
    		echo 'ERROR: ' . $e->getMessage();
    	}
    }
    
    // *****************************
    //       Таблица Settings
    // *****************************

    public static function getSettings() {
    	$result = false;
    	
    	$query = self::$database->prepare("SELECT * FROM ".PREFIX."settings");
    	$query->execute();
    	$result = $query->fetchAll();
    	
    	return $result;
    }
    
    public static function getAllSettings() {
    	$result = false;
    	
    	$query = self::$database->prepare("SELECT name, value FROM ".PREFIX."settings");
    	$query->execute();
    	$result = $query->fetchAll();
    	
    	return $result;
    }
    
    public static function updateSettings($name, $value) {
    	$result = false;
    	
    	$query = self::$database->prepare("UPDATE ".PREFIX."settings SET value=:value WHERE name=:name");
    	$result = $query->execute(array(
    				':name'  => $name,
    				':value' => $value ));
    	
    	return $result;    	 
    }
    
    
    // *****************************
    //       Таблица Templates
    // *****************************
    
    public static function getNamesTemplates() {
    	$result = false;
    	
    	$query = self::$database->prepare("SELECT name FROM ".PREFIX."templates ORDER BY `id` DESC");
    	$query->execute();
    	$result = $query->fetchAll();
    	
    	return $result;
    }
    
    
    // *****************************
    //       Таблица Pages
    // *****************************
    
    public static function getParentByUrl($url) {
    	$result = false;
        if($url) {
    		$query = self::$database->prepare("SELECT parent FROM `".PREFIX."pages` WHERE url = :url");
    		$query->execute(array(':url' => $url));
    		$res = $query->fetch();
    		if($res['parent'] > 0) {
       			$query = self::$database->prepare("SELECT title,url,parent FROM `".PREFIX."pages` WHERE id = :id");
    			$query->execute(array(':id' => $res['parent']));
    			$result = $query->fetch();
    		}
        }
    	
    	return $result;
    }
    
    public static function checkDoubleUrlPage($url) {
    	$count = false;
    	if($url) {
    		$query = self::$database->prepare("SELECT COUNT(*) as count FROM `".PREFIX."pages` WHERE url = :url");
    		$query->execute(array(':url' => $url));
    		$row = $query->fetch();
    		$count = $row['count'];
    	}
    	
    	return $count;
    }
    
    public static function searchPagesForTitle($search) {
    	$result = false;
    	
    	if($search) {
	    	$query = self::$database->prepare("SELECT id,title FROM ".PREFIX."pages WHERE (locate(:search, `title`)>0)");
	    	$query->execute(array( ':search'  => $search ));
	    	$result = $query->fetchAll();
    	}
    	
    	return $result;    	
    }
    
    public static function searchPagesForContent($search) {
    	$result = false;
    	if($search) {
	    	$query = self::$database->prepare("SELECT id,title FROM ".PREFIX."pages WHERE (locate(:search, `content`)>0)");
	    	$query->execute(array( ':search'  => $search ));
	    	$result = $query->fetchAll();
    	}
    	
    	return $result;    	
    }
    
    public static function getAllPagesForTree($parent) {
    	$result = false;
    	$query = self::$database->prepare("SELECT id,title,is_parent FROM ".PREFIX."pages WHERE parent = :parent ORDER BY `id` ASC");
    	$query->execute(array(
    			':parent'  => $parent
    			));
    	$result = $query->fetchAll();
    	
    	return $result;    	
    }
    
    public static function updatePage($data) {
    	$result = false;

    	if($data) {
    		$query = self::$database->prepare("UPDATE ".PREFIX."pages SET title=:title, url=:url, content=:content, parent=:parent, view_menu=:view_menu, template=:template WHERE id=:id");
    		$result = $query->execute(array(
    				':id'  => $data['id'],
    				':title'  => $data['title'],
    				':url'  => $data['url'],
    		    	':content'  => $data['content'],
    		    	':parent'  => $data['parent'],
    		    	':view_menu'  => $data['view_menu'],
    		    	':template'  => $data['template']
    		));    		
    	}
    	
    	return $result;
    }
    
    public static function countParentPage($parent) {
    	$count = false;
    	if($parent) {
    		$query = self::$database->prepare("SELECT COUNT(*) as count FROM `".PREFIX."pages` WHERE parent = :parent");
    		$query->execute(array(':parent' => $parent));
    		$row = $query->fetch();
    		$count = $row['count'];
    	}
    	 
    	return $count;
    }
    
    public static function findParentPage($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT parent FROM ".PREFIX."pages WHERE id = :id");
    		$query->execute(array(':id' => $id));
    		$result = $query->fetch();
    		$result = $result['parent'];
    	}
    	 
    	return $result;
    }
    
    public static function deletePage($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("DELETE FROM ".PREFIX."pages WHERE (id=:id AND status=0)");
    		$result = $query->execute(array(
    				':id'  => $id
    		));
    	}
    	 
    	return $result;
    }
    
    public static function deleteParentPages($parent) {
    	$result = false;
    	if($parent) {
    		$query = self::$database->prepare("DELETE FROM ".PREFIX."pages WHERE (parent = :parent AND status = 0)");
    		$result = $query->execute(array(
    				':parent'  => $parent
    		));
    	}
    	
    	return $result;
    }
    
    public static function uncheckIsParentPage($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("UPDATE ".PREFIX."pages SET is_parent=0 WHERE id=:id");
    		$result = $query->execute(array(
    				':id'  => $id
    				));
    	}
    	 
    	return $result;
    }
    
    public static function checkIsParentPage($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("UPDATE ".PREFIX."pages SET is_parent=1 WHERE id=:id");
    		$result = $query->execute(array(
    				':id'  => $id
    				));
    	}
    	 
    	return $result;
    }
    
    public static function newPage($data) {
    	$result = false;
    	if($data) {
    		$query = self::$database->prepare("INSERT ".PREFIX."pages (id, title, url, content, parent, date, author, template, view_menu, status, is_parent) VALUES (:id, :title, :url, :content, :parent, :date, :author, :template, :view_menu, :status, :is_parent)");
    		$result = $query->execute(array(
    				':id'  => '',
    				':title'  => $data['title'],
    				':url'  => $data['url'],
    				':content'  => $data['content'],
    				':parent'  => $data['parent'],
    				':date'  => date("Y-m-d H:i:s"),
    				':author'  => 1,
    				':template'  => $data['template'],
    				':view_menu'  => $data['view_menu'],
    				':status'  => 0,
    				':is_parent'  => 0));
    	}
    	
    	return $result;
    }
    
    public static function getContentPage($url) {
    	$result = false;
    	if($url) {
    		$query = self::$database->prepare("SELECT id,title,content,template FROM ".PREFIX."pages WHERE url = :url");
    		$query->execute(array(':url' => $url));
    		$result = $query->fetch();
    	}
    	
    	return $result;
    }
    
    public static function getContentPageById($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT id,url,view_menu,content,title,parent,template FROM ".PREFIX."pages WHERE id = :id");
    		$query->execute(array(':id' => $id));
    		$result = $query->fetch();
    	}
    	 
    	return $result;    	 
    }
    
    
    // *****************************
    //       Таблица Users
    // *****************************
    
    public static function checkNewUsers() {
    	$result = false;
    	
    	$query = self::$database->prepare("UPDATE ".PREFIX."users SET new=0 WHERE new=1");
    	$result = $query->execute();
    	 
    	return $result;
    }
    
    public static function getListUsers($count=20, $page=0) {
    	$start = $count*$page;
    	$finish = $count;
    	$result = false;
    	
	    $query = self::$database->prepare("SELECT * FROM ".PREFIX."users ORDER BY id DESC LIMIT ?, ?");
	    $query->bindParam(1, $start, PDO::PARAM_INT);
	    $query->bindParam(2, $finish, PDO::PARAM_INT);
	    $query->execute();
	    $result = $query->fetchAll();
    	
    	return $result;
    }
    
    public static function getAllUsers() {
    	$query = self::$database->prepare("SELECT id, login, name, email, level, status, picture FROM ".PREFIX."users");
    	$query->execute();
    	
    	return $query->fetchAll();
    }
    
    public static function getUserById($id) {
    	$result = false;
    	if($id) {
    		$query = self::$database->prepare("SELECT * FROM ".PREFIX."users WHERE id = :id");
    		$query->execute(array(':id' => $id));
    		$result = $query->fetch();
    	}
    	
    	return $result;
    }

    public static function getUserByHash($hash) {
    	$result = false;
    	if($hash) {
    		$query = self::$database->prepare("SELECT id, login, email, role, name, picture, status FROM ".PREFIX."users WHERE password = :password");
    		$query->execute(array(':password' => $hash));
    		$result = $query->fetch();
    	}
    	
    	return $result;
    }
    
    public static function getUserByLogin($login) {
    	$result = false;
    	if($login) {
    		$query = self::$database->prepare("SELECT password FROM ".PREFIX."users WHERE login = :login");
    		$query->execute(array(':login' => $login));
    		$result = $query->fetch();
    	}
    	 
    	return $result;
    }
    
    public static function countUserByLogin($login) {
    	$count = false;
    	if($login) {
    		$query = self::$database->prepare("SELECT COUNT(*) as count FROM `".PREFIX."users` WHERE login = :login");
    		$query->execute(array(':login' => $login));
    		$row = $query->fetch();
    		$count = $row['count'];
    	}
    	
    	return $count;
    }

    public static function countAllUsers() {
    	$count = false;
		
    	$query = self::$database->prepare("SELECT COUNT(*) as count FROM `".PREFIX."users`");
		$query->execute();
		$row = $query->fetch();
		$count = $row['count'];
    	 
    	return $count;
    }

    public static function countNewUsers() {
    	$count = false;
    	
		$query = self::$database->prepare("SELECT COUNT(*) as count FROM `".PREFIX."users` WHERE new = 1");
		$query->execute();
		$row = $query->fetch();
		$count = $row['count'];
    
    	return $count;
    }
    
    public static function updateUser($data) {
    	$result = false;
    	if($data) {
    		$query = self::$database->prepare("UPDATE ".PREFIX."users SET login=:login, email=:email, name=:name, status=:status, level=:level WHERE id=:id)");
    		$result = $query->execute(array(
    				':id'  => $data['id'],
    				':login'  => $data['login'],
    				':email'  => $data['email'],
    				':name'  => $data['name'],
    				':status'  => $data['status'],
    				':level'  => $data['level'] ));
    	}
    	 
    	return $result;    	 
    }
    
    public static function newUser($data) {
    	$result = false;
    	if($data) {
    		$query = self::$database->prepare("INSERT ".PREFIX."users (id, email, login, password, name, role, date_reg, date_last, status, picture, new) VALUES (:id, :email, :login, :password, :name, :role, :date_reg, :date_last, :status, :picture, :new)");
    		$result = $query->execute(array(
    			':id'  => '',
    			':email'  => $data['email'],
    			':login'  => $data['login'],
    			':password'  => User::generateHash(trim($data['password'])),
    			':name'  => $data['name'],
    			':role'  => 1,
    			':date_reg'  => date("Y-m-d"),
    			':date_last'  => date("Y-m-d H:i:s"),
    			':status'  => 0,
    			':picture'  => '',
    			':new'  => 1));
    	}
    	
    	return $result;
    }
    
    
    
}

?>