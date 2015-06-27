<?php
$contenteditable = '';
if($user_level==3 && $view_admin_panel == 1) {
    
$contenteditable = ' contentEditable="true"';

$admin_panel = '<script>
var max_size_content_image = '.$max_size_content_image.';
var PageId = '.$_GET['id'].';
</script>
<script src="/engine/js/admin.script.js"></script>
<div id="popup_dialogs"></div>

<div class="adminPanel" id="adminPanel" style="background-color:#C0C0FF;height:40px;width:100%;position: fixed;left: 0px;top:  0px;_position: absolute;_top: expression( 0 + eval(document.documentElement.scrollTop||document.body.scrollTop) + \'px\' );">
<div style="float:left;">
Режим редактирования&nbsp;&nbsp;
<select name="thisedit" id="thisedit" onChange="ChangeThisEdit();">
<option value="content" selected>Контент</option>
';
for($i=0;$i<count($matches_modules);$i++) $admin_panel .= '<option value="'.$matches_modules[$i].'">'.$matches_modules[$i].'</option>
    ';
$admin_panel .= '</select>
</div>
<div style="float:left;">
<span id="editContentBlock" class="editModuleBlock">
<button id="save_content" title="Сохранить"><img src="../engine/images/format-save.png" /></button>
    <div class="file_upload">
        <button type="button" title="Вставить картинку"><img src="../engine/images/format-image.png" /></button>
        <input type="file" onchange="javascript:LoadPicture(this);" name="content_picture" id="file-field" multiple="true" />
    </div>
<button class="createLink" title="Создать ссылку"><img src="../engine/images/format-link.png" /></button>
<button class="unsortedlist" title="Создать список"><img src="../engine/images/format-unsorted-list.png" /></button>
<button class="justifyleft" title="Выравнивание слева"><img src="../engine/images/format-justify-left.png" /></button>
<button class="italic" title="Курсив"><img src="../engine/images/format-text-italic.png" /></button>
<button class="underline" title="Подчеркивание"><img src="../engine/images/format-text-underline.png" /></button>
<button class="bold" title="Жирный шрифт"><img src="../engine/images/format-text-bold.png" /></button>
</span>
';
for($i=0;$i<count($matches_modules);$i++) {
    if($matches_modules[$i]=="gallery") $admin_panel .= '<span class="editModuleBlock" id="edit_'.$matches_modules[$i].'">
<button id="'.$matches_modules[$i].'_add_album" >Создать альбом</button>
<button id="'.$matches_modules[$i].'_upload">Добавить картинку</button>
</span>
';
    }
$admin_panel .= '<span id="status"></span>
</div>
<div style="float:right;">
<a href="/admin/">Админ Панель</a>&nbsp;
<a href="#" onClick="document.logout.submit();">Выйти</a>&nbsp;
</div>
<form id="logout" name="logout" method="POST"><input type="hidden" name="logout" value="yes" /></form>
</div>    
';
}
?>