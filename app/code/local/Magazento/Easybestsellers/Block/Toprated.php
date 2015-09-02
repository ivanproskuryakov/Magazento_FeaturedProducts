<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Magazento_Easybestsellers_Block_Toprated extends Mage_Catalog_Block_Product_Abstract {

    public function getTopRatedProduct() {
        $limit = $this->getData('item_count');
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
        $collection->addAttributeToSelect('*')->addStoreFilter();


        if ($this->getData('item_bestsellercategory') > 0) {
            $category = $this->getModel()->getCategory($this->getData('item_bestsellercategory'));
            $collection->addCategoryFilter($category); 
        }         
        
        // MANUAL FILTERS
        $model = Mage::getModel('easybestsellers/item')->load($this->getData('item_id'));
        if ($model->getData('assignedproduct_id')) {
            $collection_ids = $collection->getAllIds();
            $collection = Mage::getModel('easybestsellers/data')->getCombineWithManualBestsellers($collection_ids,$model->getData('assignedproduct_id'));
            $limit = $limit + count($model->getData('assignedproduct_id'));
            
        } 
//        var_dump(count($collection));              


        $_rating = array();
        foreach($collection as $_product) {
            $storeId = Mage::app()->getStore()->getId();
            $_productRating = Mage::getModel('review/review_summary')
                                ->setStoreId($storeId)
                                ->load($_product->getId());
            $_rating[] = array(
                            'rating' => $_productRating['rating_summary'],
                            'product' => $_product
                        );
        }
        arsort($_rating);
        return array_slice($_rating, 0, $limit);
    }

    public function getModel() {
        return Mage::getModel('easybestsellers/Data');
    }

}
