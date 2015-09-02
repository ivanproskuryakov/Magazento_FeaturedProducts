<?php

/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Model_Layout extends Mage_Core_Model_Abstract {

    private $entity_type = null;
    private $entity_id = null;
    
    private function _processLayout($items) {
        $update = '';        
        $layouts = array();
        foreach ($items as $_item) {
            $layouts[$_item->getData('layout').$_item->getData('order')]['layout'] = $_item->getData('layout');
            $layouts[$_item->getData('layout').$_item->getData('order')]['order'] = $_item->getData('order');
        }
              
        foreach ($layouts as $_layout) {
            $update.=  '<reference name="' . $_layout['layout'] . '">
                            <block type="easybestsellers/layout" ' . $_layout['order'] . '="-" name="easybestsellers_page_'.$_layout['layout'].$_layout['order'].'" template="magazento_easybestsellers/layout.phtml">
                                <action method="setData"><key>entity_type</key><value>'.$this->entity_type.'</value></action> 
                                <action method="setData"><key>entity_id</key><value>'.$this->entity_id.'</value></action> 
                                <action method="setData"><key>entity_layout</key><value>'.$_layout['layout'].'</value></action> 
                                <action method="setData"><key>entity_order</key><value>'.$_layout['order'].'</value></action> 
                                    
                                <block type="easybestsellers/bestseller"      name="bestseller" template="magazento_easybestsellers/bestseller.phtml"/> 
                                <block type="easybestsellers/new"             name="new"        template="magazento_easybestsellers/new.phtml"/> 
                                <block type="easybestsellers/popular"         name="popular"    template="magazento_easybestsellers/popular.phtml"/> 
                                <block type="easybestsellers/toprated"        name="toprated"   template="magazento_easybestsellers/toprated.phtml"/> 
                                <block type="easybestsellers/review"          name="review"     template="magazento_easybestsellers/review.phtml"/>                                     

                            </block>
                        </reference>';
        }
        return $update;
    }

    private function fetchCMSLayoutUpdates() {
        $page_id = Mage::getSingleton('cms/page')->getId();
        $items = Mage::getModel('easybestsellers/item')->getPageItems($page_id,Mage::app()->getStore()->getId());
//        var_dump(count($items));
        if ($items) {
            $this->entity_type = 'page';
            $this->entity_id = $page_id;
            return $this->_processLayout($items);
        }
    }

    private function fetchCategoryLayoutUpdates() {
        $category_id = Mage::getModel('catalog/layer')->getCurrentCategory()->getId();
        $items = Mage::getModel('easybestsellers/item')->getCategoryItems($category_id,Mage::app()->getStore()->getId());
        if ($items) {
            $this->entity_type = 'category';
            $this->entity_id = $category_id;
            return $this->_processLayout($items);
        }        
    }

    private function fetchProductLayoutUpdates() {
        $product_id = Mage::registry('current_product')->getId();
        $items = Mage::getModel('easybestsellers/item')->getProductItems($product_id,Mage::app()->getStore()->getId());
        if ($items) {
            $this->entity_type = 'product';
            $this->entity_id = $product_id;
            return $this->_processLayout($items);
        }        
    }

    public function fetchDbLayoutUpdates(Varien_Event_Observer $observer) {
        $layout = $observer->getEvent()->getLayout();
        if ((Mage::app()->getRequest()->getControllerName() == 'page')
           || (Mage::app()->getRequest()->getControllerName() == 'index')) {
            $layout->getUpdate()->addUpdate($this->fetchCMSLayoutUpdates());
        }
        if (Mage::app()->getRequest()->getControllerName() == 'category') {
            $layout->getUpdate()->addUpdate($this->fetchCategoryLayoutUpdates());
        }
        if (Mage::app()->getRequest()->getControllerName() == 'product') {
            $layout->getUpdate()->addUpdate($this->fetchProductLayoutUpdates());
        }

        $layout->generateXml();
    }

}