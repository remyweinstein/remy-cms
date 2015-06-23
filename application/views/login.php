<?php 
   if(isset($_POST['referer']) && $_POST['referer']!="") $ref_link = $_POST['referer'];
    else $ref_link = $_SERVER['HTTP_REFERER'];
   if($ref_link=="" || $ref_link == Engine::$settings['main_host']."login/") $ref_link = "/";

  if(isset($_POST['action']) && $_POST['action'] == "login") {
	
	$data = dB::getUserByLogin($_POST['login']);
	
    if($data['password'] === crypt($_POST['password'], $data['password'])) {
        $_SESSION['hash'] = $data['password'];
        Engine::DirectLink($ref_link);
        } else $error = "Вы ввели неправильный логин/пароль";
  }
echo $error;
?>
<br><form method="POST">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="referer" value="<?php echo $ref_link; ?>" />
<div class="input_string"><div><i class="glyphicon glyphicon-user"></i></div> <input name="login" type="text" placeholder="Логин"></div>
<div>&nbsp;</div>
<div class="input_string"><div><i class="glyphicon glyphicon-lock"></i></div> <input name="password" type="password" placeholder="Пароль"></div>
<div>&nbsp;</div>
<div style="text-align:center;"><button type="submit">Войти</button></div>
</form>