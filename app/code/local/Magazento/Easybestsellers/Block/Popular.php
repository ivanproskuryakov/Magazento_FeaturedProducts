<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Popular extends Mage_Catalog_Block_Product_Abstract {

    protected function _beforeToHtml() {
        $storeId    = Mage::app()->getStore()->getId();
        $collection = Mage::getResourceModel('reports/product_collection')
                    ->addOrderedQty()
                    ->addAttributeToSelect('*')
                    ->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
                    ->setStoreId($storeId)
                    ->addStoreFilter($storeId)
                    ->addViewsCount();
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        $collection ->setPageSize($this->getData('item_count'))
                    ->setCurPage(1);

        if ($this->getData('item_bestsellercategory') > 0) {
            $category = $this->getModel()->getCategory($this->getData('item_bestsellercategory'));
            $collection->addCategoryFilter($category); 
        }        
        
        // MANUAL FILTERS
        $model = Mage::getModel('easybestsellers/item')->load($this->getData('item_id'));
        if ($model->getData('assignedproduct_id')) {
            $collection_ids = array_slice($collection->getAllIds(), 0, $this->getData('item_count'));
            $collection = Mage::getModel('easybestsellers/data')->getCombineWithManualBestsellers($collection_ids,$model->getData('assignedproduct_id'));
        }            


        $this->setProductCollection($collection);
        return parent::_beforeToHtml();
    }

    public function getModel() {
        return Mage::getModel('easybestsellers/Data');
    }

}

