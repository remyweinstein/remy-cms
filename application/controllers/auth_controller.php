<?php

class auth_Controller extends Base_Controller {
    private $model;
    public $error_message="";
    public $ref_link;

    public function __construct() {
        parent::__construct();
            
        $this->model = new auth_Model();
        if(Engine::$curUrlName=="login") {
            self::procInputLogin();
            $this->title = "Авторизация";
        }
        if(Engine::$curUrlName=="registration") {
            self::procInputReg();
            $this->title = "Регистрация";
        }
        $this->getView(Engine::$curUrlName);
    }

    private function procInputReg() {
        if(isset($_POST['action']) && $_POST['action'] == "registration") {
            if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['reg_login'])) {
                $this->error_message = "Логин может состоять только из букв английского алфавита и цифр";
            }
            if(strlen($_POST['reg_login']) < 3 or strlen($_POST['reg_login']) > 30) {
            $this->error_message = "Логин должен быть не меньше 3-х символов и не больше 30";
            }
            if($this->model->countUserByLogin($_POST['reg_login']) > 0) {
                $this->error_message = "Пользователь с таким логином уже существует в базе данных";
            }
            if($this->error_message == "") {
                $data['login'] = $_POST['reg_login'];
                $data['password'] = $_POST['reg_password'];
                $data['name'] = $_POST['reg_name'];
                $data['email'] = $_POST['reg_email'];
                if($this->model->addNewUser($data)) {
                    Engine::DirectLink(Engine::$settings['main_host']);
                }
            }
        }
    }
    
    private function procInputLogin() {
        if(isset($_POST['referer']) && $_POST['referer']!="") {
            $this->ref_link = $_POST['referer'];
        } else {
            $this->ref_link = $_SERVER['HTTP_REFERER'];
        }
        if($this->ref_link=="" || $this->ref_link == Engine::$settings['main_host']."login/") {
            $this->ref_link = "/";
        }
        if(isset($_POST['action']) && $_POST['action'] == "login") {
            $data = $this->model->getUserByLogin($_POST['login']);
            if($data['password'] === crypt($_POST['password'], $data['password'])) {
                $_SESSION['hash'] = $data['password'];
                Engine::DirectLink($this->ref_link);
            } else {
                $this->error_message = "Вы ввели неправильный логин/пароль";
            }
        }
    }
        
    private function getView($views) {
        ob_start();
        include APP_VIEWS.$views.'_view.php';
        $this->content = ob_get_contents();
        ob_end_clean();
        Engine::$curIdPage = "";
        Engine::$curTemplate = "auth";        
    }        

}
