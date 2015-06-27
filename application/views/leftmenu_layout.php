<ul>
<?php for($i=0;$i<count($data);$i++) { ?>
<li<?php echo (Engine::$curUrlName==$data[$i]['url']) ? ' class="active"' : ''; ?>>
    <a href="/catalog/<?php echo $data[$i]['url'] ?>"><?php echo $data[$i]['title'] ?></a>
</li>
<?php } ?>
</ul>
