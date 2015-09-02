<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Magazento_Easybestsellers_Model_Item extends Mage_Core_Model_Abstract
{
    const CACHE_TAG     = 'easybestsellers_item';
    protected $_cacheTag= 'easybestsellers_item';
    private $order = null;
    private $layout = null;
    

    protected function _construct()
    {
        $this->_init('easybestsellers/item');
    }
    
    public function getCheckoutItems($store) {
        $collection = $this->getCollection();
        $collection ->addFilter('is_active', 1);
        $collection ->addFilter('on_checkout', 1);
        $collection ->addStoreFilter($store);
        $collection ->addNowFilter();
        $collection ->addOrder('position', 'ASC');
        
        return $collection;
    }        
    
    public function getPageItems($id,$store = 0) {
        $collection = $this->getCollection();
        $collection ->addFilter('is_active', 1);
        $collection ->addStoreFilter($store);
        $collection ->addPageFilter($id);
        $collection ->addOrder('position', 'ASC');
        $collection ->addNowFilter();        
        if ($this->layout)  {
            $collection ->addLayoutFilter($this->layout,$this->order);            
        }
        return $collection;
    }        
    
    public function getCategoryItems($id,$store = 0) {
        $collection = $this->getCollection();
        $collection ->addFilter('is_active', 1);
        $collection ->addStoreFilter($store);
        $collection ->addCategoryFilter($id);
        $collection ->addOrder('position', 'ASC');
        $collection ->addNowFilter();       
        if ($this->layout)  {
            $collection ->addLayoutFilter($this->layout,$this->order);            
        }
        return $collection;
    }        
    public function getProductItems($id,$store = 0) {
        
        $collection = $this->getCollection();
        $collection ->addFilter('is_active', 1);
        $collection ->addStoreFilter($store);
        $collection ->addProductFilter($id);
        $collection ->addOrder('position', 'ASC');
        $collection ->addNowFilter();        
        if ($this->layout)  {
            $collection ->addLayoutFilter($this->layout,$this->order);            
        }
        
        return $collection;
    }    
    
    
    
    public function getLayoutItems($type ,$_layout, $_order,$id,$store) {
        $this->layout = $_layout;
        $this->order = $_order;
        switch ($type) {
            case 'product':
                return $this->getProductItems($id, $store);
                break;
            case 'category':
                return $this->getCategoryItems($id, $store);
                break;
            case 'page':
                return $this->getPageItems($id, $store);
                break;
            default:
                break;
        }        
    }        
    
    
    
    
}
