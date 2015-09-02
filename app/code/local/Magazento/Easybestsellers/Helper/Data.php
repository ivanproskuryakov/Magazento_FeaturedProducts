<?php

/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getTitleNew() {
        return Mage::getStoreConfig('easybestsellers/new/title');
    }

    public function getTitlePopular() {
        return Mage::getStoreConfig('easybestsellers/popular/title');
    }

    public function getTitleReview() {
        return Mage::getStoreConfig('easybestsellers/review/title');
    }

    public function getTitleToprated() {
        return Mage::getStoreConfig('easybestsellers/toprated/title');
    }

    public function getTitleTopSell() {
        return Mage::getStoreConfig('easybestsellers/topsell/title');
    }

    public function getCurrentCategory() {

        if (Mage::app()->getFrontController()->getRequest()->getRouteName() == 'cms') {
            return array('route' => 'page', 'category' => 0);
        }

        if (Mage::registry('current_product') != null) {
            $_category = Mage::registry('current_product')->getCategoryIds();
            return array('route' => 'product', 'category' => $_category[0]);
        }
//        
        if (Mage::registry('current_category') != null) {
            return array('route' => 'catalog', 'category' => Mage::registry('current_category')->getId());
        }        
    }

    
    //.......
    
    public function getTypes() {
        
        $type = array();
        $type['bestseller'] = 'Best Sellers';
        $type['toprated'] = 'Top Rated';
        $type['review'] = 'Reviews';
        $type['popular'] = 'Popular';
        $type['new'] = 'New products';
        return $type; 
    }
    public function getLayoutTypes() {
        
        $type = array();
        $type['left'] = 'Left column';
        $type['right'] = 'Right column';
        $type['content'] = 'Content';
        return $type; 
    }
    public function getLayoutOrder() {
        
        $type = array();
        $type['before'] = 'Top';
        $type['after'] = 'Bottom';
        return $type; 
    }
    public function versionUseAdminTitle() {
        $info = explode('.', Mage::getVersion());
        if ($info[0] > 1) {
            return true;
        }
        if ($info[1] > 3) {
            return true;
        }
        return false;
    }

    public function versionUseWysiwig() {
        $info = explode('.', Mage::getVersion());
        if ($info[0] > 1) {
            return true;
        }
        if ($info[1] > 3) {
            return true;
        }
        return false;
    }
    
    public function numberArray($max,$text) {

        $items = array();
        for ($index = 1; $index <= $max; $index++) {
            $items[$index]=$text.' '.$index;
        }
        return $items;
    }
    
        
    
}