<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Admin_Item_Grid_Renderer_Product extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row) {
        $_product = Mage::getModel('catalog/product')->load($row->getData('product_entity_id'));
        $img = '<img style="margin-right:5px;float:left; border:1px solid #ddd " src="'.$this->helper('catalog/image')->init($_product, 'small_image')->resize(50, 50).'">';
        $html = $img .  $_product->setStoreId($row->getData('store_id'))->getName();
        return $html;
    }    
}
