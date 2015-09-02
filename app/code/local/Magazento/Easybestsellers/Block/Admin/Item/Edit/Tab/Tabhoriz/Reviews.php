<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Magazento_Easybestsellers_Block_Admin_Item_Edit_Tab_Tabhoriz_Reviews extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
       
        parent::__construct();
        $this->setId('reviews');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection() {
        
        $model = Mage::getModel('review/review');
        $collection = $model->getCollection();
        $this->setCollection($collection);
     
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns() {
         $this->addColumn('in_assignedreviews', array(
            'header_css_class' => 'a-center',
            'type'      => 'checkbox',
            'field_name'=> 'assigned_reviewslist[]',
            'values'    => $this->_getSelectedProducts(),
            'align'     => 'center',
            'index'     => 'review_id'
        ));
         
//        $this->addColumn('review_id', array(
//            'header' => Mage::helper('catalog')->__('ID'),
//            'width' => '50px',
//            'type' => 'number',
//            'index' => 'review_id',
//        ));
        
        $this->addColumn('review_title', array(
            'header' => Mage::helper('catalog')->__('Title'),
            'index' => 'title',
        ));
        $this->addColumn('review_nickname', array(
            'header' => Mage::helper('catalog')->__('Nickname'),
            'index' => 'nickname',
        ));
        $this->addColumn('review_detail', array(
            'header' => Mage::helper('catalog')->__('Detail'),
            'index' => 'detail',
        ));
        return parent::_prepareColumns();
    }

    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/reviewsGrid', array('_current'=>true));
    }    

    
    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_assignedreviews') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            // Nasty code :D
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('detail.review_id', array('in'=>$productIds));
            } else {
                if($productIds) {
                    $this->getCollection()->addFieldToFilter('detail.review_id', array('nin'=>$productIds));
                }
            }
            // End of Nasty code
//            $sql = $this->getCollection()->getSelect()->__toString();
//            Mage::log('Review:'.$sql,null,'Magazento_EasyBestsellers.log');
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }
    
    protected function _getSelectedProducts()
    {
        $products = $this->getRequest()->getPost('products', null);
        
        if (!is_array($products)) {
            $id = Mage::app()->getFrontController()->getRequest()->get('item_id');
            $model = Mage::getModel('easybestsellers/item')->load($id);
            $products = $model->getData('assignedreview_id');
        }
//        var_dump($products);
        return $products;
    }    
 
}

?>
