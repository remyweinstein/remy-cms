<?php

class auth_Model {
    public $data_user;
    
    public function __construct($login) {
        $this->data_user = self::getUserByLogin($login);
    }
    
    public function getUserByLogin($login) {
        $data = dB::getUserByLogin($login);
        return $data;
    }
    
    public function countUserByLogin($login) {
        $count = dB::countUserByLogin($_POST['reg_login']);
        return $count;
    }
    
    public function addNewUser($data) {
        dB::newUser($data);
    }
    
    
}