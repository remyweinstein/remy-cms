<div class="product_box_details">
    <img src="/uploads/<?php echo $this->data_item['pic_url'] ?>" alt=""style="width:250px;" class="prod_image" />
    <div class="product_details_wide">
        <div class="prod_title1"><?php echo $this->data_item['title'] ?></div>
        <p> <?php echo $this->data_item['annotation'] ?> </p>
        <p class="price">Размеры: <?php echo $this->variants ?></p>
        <br><br>
        <p class="price">Цена: <span class="price"><?php echo $this->data_item['price'] ?> Р</span></p>
    </div>
</div>
<div class="title1"><span>Описание</span></div>
<?php echo $this->data_item['content'] ?>
<div class="title"><span>Рекомендованные товары</span></div>
<?php echo $this->recomended ?>
