<?php

class Ajax_Model {
    
    public function __construct() {
        
    }
    
    public function unlinkpropfromcat($data){
        $query = explode(":", $data);
        dBShop::deletePropCat($query[1],$query[3]);
        $id_tovs = dBShop::searchForCleanProps($query[1],$query[3]);
        for($i=0;$i<count($id_tovs);$i++){
            $prop = ereg_replace($query[1].'_[0-9]+', '', $id_tovs[$i]['props']);
            dBShop::updateItemProps($id_tovs[$i]['id'], trim(str_replace("  ", " ", $prop)));
        }
    }
    
    public function addproptocat($data) {
        $query = explode(":", $data);
        $query['id_cat'] = $query[3];
        $query['pid'] = $query[1];
        dBShop::addProp($query);
        
    }
    
    public function addnewpropvalue($data) {
        $query = explode(":", $data);
        $pid = $query[1];
        $value = $query[3];
        $result = dBShop::newPropValue($pid, $value);

        return $result;
    }
    
    public function addnewprop($dat) {
        $query = explode(":", $dat);
        $data['name'] = $query[1];
        $value = $query[3];
        $result = dBShop::newPropName($data);
        if($result>0) {
            //$vid = 
            dBShop::newPropValue($result, $value);
        }
        return $result;
    }
    
    public function addnewskuname($name){
        $query = explode(":", $name);
        $data['name'] = $query[1];
        //$value = $query[3];
        $result = dBShop::newSkuName($data);
        
        return $result;
    }
    public function addnewvalueskutogoods($data) {
        $result = '<div id="popup_name" class="popup_block">
                <div id="popup_block_list">
                ';
        $all_skus_names = dBShop::getSkuValues($data);
        for($i=0;$i<count($all_skus_names);$i++){
            $result .= '<div id="div_sku_'.$all_skus_names[$i]['id'].'" style="padding:10px 30px 10px 0px;float:left;">
                    <a href="#" onClick="AddSkuToGoods('.$all_skus_names[$i]['id'].', \''.$all_skus_names[$i]['name'].'\');">'
                    .$all_skus_names[$i]['name'].
                    '</a></div>
                    ';
        }
        $result .= '            <div style="clear:both;width:100%;">&nbsp;</div>
            <div style="padding:10px 30px 10px 0px;">
                Варианты товара: <input type="text" name="newskuname" id="newskuname" value=""/> например, Размер<br>
                <button onclick="AddNewSkuName();">Добавить</button>
            </div>
            </div>';
        
        return $result;        
    }
    public function addskustogoods($data){
        //$id = $data;
        $result = '<div id="popup_name" class="popup_block">
                <div id="popup_block_list">
                ';
        $all_skus_names = dBShop::getAllSkuNames();
        for($i=0;$i<count($all_skus_names);$i++){
            $result .= '<div id="div_sku_'.$all_skus_names[$i]['id'].'" style="padding:10px 30px 10px 0px;float:left;">
                    <a href="#" onClick="AddSkuToGoods('.$all_skus_names[$i]['id'].', \''.$all_skus_names[$i]['name'].'\');">'
                    .$all_skus_names[$i]['name'].
                    '</a></div>
                    ';
        }
        $result .= '            <div style="clear:both;width:100%;">&nbsp;</div>
            <div style="padding:10px 30px 10px 0px;">
                Варианты товара: <input type="text" name="newskuname" id="newskuname" value=""/> например, Размер<br>
                <button onclick="AddNewSkuName();">Добавить</button>
            </div>
            </div>';
        
        return $result;
    }
    
    public function addpropstocat($data){
        $category = $data;
        $result = '<div id="popup_name" class="popup_block"><div id="popup_block_list">';
        $props_cat = dBShop::getCatProps($category);
        $all_props = dBShop::getAllProps();
        for($i=0;$i<count($all_props);$i++){
            if(!in_array($all_props[$i]['id'], $props_cat)) {
                $result .= '<div id="div_prop_'.$all_props[$i]['id'].'" style="padding:10px 30px 10px 0px;float:left;">
                <a href="#" onClick="AddPropToCat('.$all_props[$i]['id'].', '.$category.', \''.$all_props[$i]['name'].'\');">'.$all_props[$i]['name'].'</a>
                </div>';
            }
        }
        $result .= '</div>
            <div style="clear:both;width:100%;">&nbsp;</div>
            <div style="padding:10px 30px 10px 0px;">
                Характеристика товара: <input type="text" name="newprop" id="newprop" value=""/> например, Производитель<br>
                Значение: <input type="text" name="newvalue" id="newvalue" value=""/> например, Россия<br>
                <button onclick="AddNewProp('.$category.');">Добавить</button>
            </div>
            </div>';
        
        return $result;
    }
    
	
}