<?php
$arr_settings = $contentPage -> arrSettings();
?>
<div id="content" class="col-lg-10 col-sm-10">

<ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#base">Основные</a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div class="tab-pane active" id="base">

        
            <div class="box col-md-6">
                <div class="box-inner homepage-box">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-list-alt"></i> SEO</h2>
                    </div>
                    <div class="box-content">
                    	<table style="width:530px;">
							<tbody>
                        <form action="" method="POST">
<?php
foreach ($arr_settings['base'] as $value) {
?>
<tr>
<td style="height:40px;width:250px;"><?php echo $value[0] ?>:</td>
<td style="height:40px;"><input type="text" name="<?php echo $value[1] ?>" value="<?php echo $value[2] ?>" size="<?php echo $value[3] ?>" /></td>
</tr>
<?php
}
?>
				               <input type="hidden" name="edit_settings" value="edit" />
                            <tr>
                            	<td colspan="2" style="text-align:center;width=100%;">
                            	<p><div style="clear:both;"></div></p>
                            		<button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button>
                            	</td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
 
            <div class="box col-md-6">
                <div class="box-inner homepage-box">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-cog"></i> Система</h2>
                    </div>
                    <div class="box-content">
                    	<table style="width:530px;">
							<tbody>
                        <form action="" method="POST">
<?php

foreach ($arr_settings['system'] as $value) {
    if($value[1] == "current_template") {
?>
<tr>
<td style="height:40px;width:250px;"><?php echo $value[0]?>:</td>
<td style="height:40px;"><?php echo $contentPage->getOptionsTemplates() ?></td>
</tr>
<?php
        $now_template = $value[2];
    } else if($value[1] == "view_admin_panel") {
?>
<tr>
<td style="height:40px;width:250px;">
	<?php echo $value[0] ?>:
</td>
<td style="height:40px;">
        	<input data-no-uniform="true" name="<?php echo $value[1] ?>" type="checkbox" class="iphone-toggle"<?php echo $value[2]==1 ? " checked" : ""; ?>>
</td>
        	<input type="hidden" name="check_view_admin_panel" value="1" />
<?php } else { ?>
<tr>
<td style="height:40px;width:250px;"><?php echo $value[0] ?>:</td>
<td style="height:40px;"><input type="text" name="<?php echo $value[1] ?>" value="<?php echo $value[2] ?>" size="<?php echo $value[3] ?>" /></td>
</tr>
<?php		}
} ?>
				               <input type="hidden" name="edit_settings" value="edit" />             
                            <tr>
                            	<td colspan="2" style="text-align:center;width=100%;">
									<p><div style="clear:both;"></div></p>
                            		<button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button>
                            	</td>
                            </tr>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
              <script>
                $("#edit_template [value=\'<?php echo $now_template ?>\']").attr("selected", "selected");
              </script>
            </div>
 
            <div class="box col-md-6">
                <div class="box-inner homepage-box">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-th"></i> Галерея</h2>
                    </div>
                    <div class="box-content">
                    	<table style="width:530px;">
							<tbody>
                    <form action="" method="POST">
<?php
foreach ($arr_settings['gallery'] as $value) {
?>
<tr>
<td style="height:40px;width:250px;">
<?php echo $value[0] ?>:
</td>
<td style="height:40px;">
<input type="text" name="<?php echo $value[1] ?>" value="<?php echo $value[2] ?>" size="<?php echo $value[3] ?>" />
</td>
</tr>
<?php
}
?>
							<input type="hidden" name="edit_settings" value="edit" />             
                            <tr>
                            	<td colspan="2" style="text-align:center;width=100%;">
									<p><div style="clear:both;"></div></p>
									<button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></p>
								</td>
							</tr>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box col-md-6">
                <div class="box-inner homepage-box">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-envelope"></i> Почта</h2>
                    </div>
                    <div class="box-content">
                    	<table style="width:530px;">
							<tbody>
                        <form action="" method="POST">
<?php
foreach ($arr_settings['mail'] as $value) {
?>
<tr>
<td style="height:40px;width:250px;">
	<?php echo $value[0] ?>:
</td>
<td style="height:40px;">
	<input type="text" name="<?php echo $value[1] ?>" value="<?php echo $value[2] ?>" size="<?php echo $value[3] ?>" />
</td>
</tr>
<?php
}
?>
							<input type="hidden" name="edit_settings" value="edit" />             
                            	<tr>
                            	<td colspan="2" style="text-align:center;width=100%;">
									<p><div style="clear:both;"></div></p>
									<button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button></p>
								</td>
								</tr>
                        </form>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    
            <div class="box col-md-6">
                <div class="box-inner" homepage-box>
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i> Авторизация</h2>
                    </div>
                    <div class="box-content">
                    	<table style="width:530px;">
							<tbody>
                    <form action="" method="POST">
<?php
foreach ($arr_settings['security'] as $value) {
    if($value[1]=="disable_registration") {
?>
<tr>
<td style="height:40px;width:250px;">
	<?php echo $value[0] ?>:
</td>
<td style="height:40px;">
<input data-no-uniform="true" name="<?php echo $value[1] ?>" type="checkbox"<?php echo $value[2]==1 ? " checked" : ""; ?>>
</td>
</tr>
<input type="hidden" name="check_registration" value="1" />
<?php
		} else {
?>
<tr>
<td style="height:40px;width:250px;">
	<?php echo $value[0] ?>:
</td>
<td style="height:40px;">
	<input type="text" name="<?php echo $value[1] ?>" value="<?php echo $value[2] ?>" size="<?php echo $value[3] ?>" />
</td>
</tr>
<?php
		}
    }
?>
							<input type="hidden" name="edit_settings" value="edit" />
                            	<tr>
                            	<td colspan="2" style="text-align:center;width=100%;">
									<p><div style="clear:both;"></div></p>
									<button class="btn btn-primary btn-sm" onClick="submit();">Сохранить</button>
								</td>
								</tr>
							</tbody>
							</table>
                        </form>
                    </div>
                </div>
            </div>
 
 
 
</div>
</div>
</div>
</div>