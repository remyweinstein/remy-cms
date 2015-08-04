<?php 
if(Engine::$user->Role != false) {
?>
    Вы уже авторизованы на сайте!
<?php
} else {
echo $this->error_message;
?>
<br><form method="POST">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="referer" value="<?php echo $this->ref_link; ?>" />
<div class="input_string"><div><i class="glyphicon glyphicon-user"></i></div> <input name="login" type="text" placeholder="Логин"></div>
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-lock"></i></div> <input name="password" type="password" placeholder="Пароль"></div>
<div>&nbsp;</div>
<div style="text-align:center;"><button type="submit">Войти</button></div>
</form>
<?php } ?>