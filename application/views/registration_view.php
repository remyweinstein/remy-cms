<?php
 if(Engine::$settings['disable_registration'] == 1) {
  if(isset($_POST['action']) && $_POST['action'] == "registration") {
    $error = "";
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['reg_login'])) {
        $error = "Логин может состоять только из букв английского алфавита и цифр";
        }
    if(strlen($_POST['reg_login']) < 3 or strlen($_POST['reg_login']) > 30) {
        $error = "Логин должен быть не меньше 3-х символов и не больше 30";
        }
    if(dB::countUserByLogin($_POST['reg_login']) > 0) {
        $error = "Пользователь с таким логином уже существует в базе данных";
        }
    if($error == "") {
        $data['login'] = $_POST['reg_login'];
        $data['password'] = $_POST['reg_password'];
        $data['name'] = $_POST['reg_name'];
        $data['email'] = $_POST['reg_email'];        
        if(dB::newUser($data)) {
        	Engine::DirectLink(Engine::$settings['main_host']);        	
		}
    }
}
echo $error;
?>
<br><form method="POST">
<input type="hidden" name="action" value="registration">
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-user"></i></div> <input name="reg_login" type="text" placeholder="Логин"></div>
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-lock"></i></div> <input name="reg_password" type="password" placeholder="Пароль"></div>
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-edit"></i></div> <input name="reg_name" type="text" placeholder="Ваше имя"></div>
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-envelope"></i></div> <input name="reg_email" type="text" placeholder="Ваш email"></div>
<div>&nbsp;</div>
<div style="text-align:center;"><input name="submit" type="submit" value="Зарегистрироваться"></div>
</form>
<?php } else { ?>
	Регистрация запрещена!
<?php } ?>