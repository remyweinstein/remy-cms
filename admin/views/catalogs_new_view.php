<div id="content" class="col-lg-10 col-sm-10">
<div class="row">
<div class="box col-md-12">
<div class="box-inner">

<div class="box-header well" data-original-title="">
  <h2><i class="glyphicon glyphicon-globe"></i> Категории - Новая категория</h2>
</div>

<div class="box-content">
<table class="table table-striped">
<tbody>
  <form method="POST" action="/admin/catalogs/">
  <tr><td>Название:</td><td><input type="text" id="edit_title" name="edit_title" value="" size="100" /></td></tr>
  <tr><td>URL:</td><td><input type="text" id="edit_url" name="edit_url" value="" size="100" /></td></tr>
  <tr><td>Родитель:</td><td>
  	 <select name="edit_parent" id="edit_parent">
     <option value="0"> --- </option>
     <?php echo $this->printParentCats() ?>
     </select>
  </td></tr>
  <tr><td>Показывать в меню:</td><td><input type="checkbox" name="edit_view_menu" value="1" checked /></td></tr>
  <tr><td colspan="2"><textarea name="edit_content" style="width:100%;height:500px;"></textarea></td></tr>
  <tr><td colspan="2"><button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></td></tr>
  </form>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script>
    $("#edit_parent [value=\'<?php echo $_GET['add_category'] ?>\']").attr("selected", "selected");
    function translit(){
        var space = '-'; 
        var text = $('#edit_title').val().toLowerCase();
        var transl = {
            'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ё':'e','ж':'zh', 
            'з':'z','и':'i','й':'j','к':'k','л':'l','м':'m','н':'n',
            'о':'o','п':'p','р':'r','с':'s','т':'t','у':'u','ф':'f','х':'h',
            'ц':'c','ч':'ch','ш':'sh','щ':'sh','ъ':'','ы':'y','ь':'','э':'e','ю':'yu','я':'ya',
            ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
            '#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
            '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
            ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
            '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
            '?': space, '<': space, '>': space, '№':space
        }
        var result = '';
        var curent_sim = '';
        for(i=0; i < text.length; i++) {
            if(transl[text[i]] != undefined) {
                if(curent_sim != transl[text[i]] || curent_sim != space){
                    result += transl[text[i]];
                    curent_sim = transl[text[i]];
                }
            } else {
                result += text[i];
                curent_sim = text[i];
            }
        }
                
        result = TrimStr(result);
        $('#edit_url').val(result);    
    }
    function TrimStr(s) {
        s = s.replace(/^-/, '');
        return s.replace(/-$/, '');
    }
    $(function(){
        $('#edit_title').keyup(function(){
            translit();
            return false;
        });
    });
  </script>