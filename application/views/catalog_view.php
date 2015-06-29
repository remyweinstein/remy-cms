<?php for($i=0;$i<count($this->data_items);$i++) { ?>
<div class="product_box"> <img src="/uploads/<?php echo $this->data_items[$i]['pic_url'] ?>" style="width:144px;height:216px;" alt="" class="prod_image" />
        <div class="product_details">
          <div class="prod_title"><?php echo $this->data_items[$i]['title'] ?></div>
          <p> <?php echo $this->data_items[$i]['annotation'] ?> </p>
          <p class="price">Цена: <span class="price"><?php echo $this->data_items[$i]['price'] ?> Р</span></p>
          <div class="button"><a href="/item/<?php echo $this->data_items[$i]['url'] ?>/">Подробнее</a></div>
        </div>
      </div>
<?php }