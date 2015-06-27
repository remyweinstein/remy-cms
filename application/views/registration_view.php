<?php
if(Engine::$settings['disable_registration'] == 1) {
    echo $this->error_message;
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