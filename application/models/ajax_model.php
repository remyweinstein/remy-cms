<?php

class Ajax_Model {
    
    public function __construct() {
        
    }
    
    public function unlinkpropfromcat($data){
        $data = explode(":", $data);
        dBShop::deletePropCat($data[1],$data[3]);
        $id_tovs = dBShop::searchForCleanProps($data[1],$data[3]);
        for($i=0;$i<count($id_tovs);$i++){
            $prop = ereg_replace($data[1].'_[0-9]+', '', $id_tovs[$i]['props']);
            dBShop::updateItemProps($id_tovs[$i]['id'], trim(str_replace("  ", " ", $prop)));
        }
    }
    
    public function addproptocat($data) {
        $data = explode(":", $data);
        $query['id_cat'] = $data[3];
        $query['pid'] = $data[1];
        dBShop::addProp($query);
        
    }
    
    public function addnewpropvalue($data) {
        $data = explode(":", $data);
        $pid = $data[1];
        $value = $data[3];
        $query = dBShop::newPropValue($pid, $value);

        return $query;
    }
    
    public function addnewprop($dat) {
        $dat = explode(":", $dat);
        $data['name'] = $dat[1];
        $value = $dat[3];
        $result = dBShop::newPropName($data);
        if($result>0) {
            $vid = dBShop::newPropValue($result, $value);
        }
        return $result;
    }
    
    public function addpropstocat($data){
        $category = $data;
        $result = '<div id="popup_name" class="popup_block">
                <div id="popup_block_list">
                ';
        $props_cat = dBShop::getCatProps($category);
        $all_props = dBShop::getAllProps();
        for($i=0;$i<count($all_props);$i++){
            if(!in_array($all_props[$i]['id'], $props_cat)) {
                $result .= '<div id="div_prop_'.$all_props[$i]['id'].'" style="padding:10px 30px 10px 0px;float:left;">
                <a href="#" onClick="AddPropToCat('.$all_props[$i]['id'].', '.$category.', \''.$all_props[$i]['name'].'\');">'.$all_props[$i]['name'].'</a>
                </div>
                ';
            }
        }
        $result .= '</div>
            <div style="clear:both;width:100%;">&nbsp;</div>
            <div style="padding:10px 30px 10px 0px;">
                Характеристика товара: <input type="text" name="newprop" id="newprop" value=""/> например, Производитель<br>
                Значение: <input type="text" name="newvalue" id="newvalue" value=""/> например, Россия<br>
                <button onclick="AddNewProp('.$category.');">Добавить</button>
            </div>
            </div>
                ';
        
        return $result;
    }
    
	
}