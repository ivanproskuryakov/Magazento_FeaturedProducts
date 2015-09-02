<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Admin_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('EasybestsellersGrid');
        $this->setDefaultSort('item_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('easybestsellers/item')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $baseUrl = $this->getUrl();
        $this->addColumn('title', array(
            'header' => Mage::helper('easybestsellers')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));
        
        $this->addColumn('bestseller_type', array(
            'header' => Mage::helper('easybestsellers')->__('Automation type'),
            'index' => 'bestseller_type',
            'type' => 'options',
            'width' => '200px',             
            'options' => Mage::helper('easybestsellers/data')->getTypes(),
        ));      
        if (Mage::getStoreConfig('easybestsellers/options/bigsize')) { 
            $this->addColumn('position', array(
                'header' => Mage::helper('easybestsellers')->__('Position'),
                'align' => 'left',
                'index' => 'position',
            ));        
            $this->addColumn('colcount', array(
                'header' => Mage::helper('easybestsellers')->__('Columns'),
                'align' => 'left',
                'index' => 'colcount',
            ));        
            $this->addColumn('layout', array(
                'header' => Mage::helper('easybestsellers')->__('Layout'),
                'index' => 'layout',
                'type' => 'options',
                'options' => Mage::helper('easybestsellers/data')->getLayoutTypes(),
            ));        
            $this->addColumn('order', array(
                'header' => Mage::helper('easybestsellers')->__('Order'),
                'index' => 'order',
                'type' => 'options',
                'options' => Mage::helper('easybestsellers/data')->getLayoutOrder(),
            ));        
        }
        
        $this->addColumn('on_checkout', array(
            'header' => Mage::helper('easybestsellers')->__('On Checkout page'),
            'index' => 'on_checkout',
            'type' => 'options',
            'options' => array(
                0 => Mage::helper('easybestsellers')->__('No'),
                1 => Mage::helper('easybestsellers')->__('Yes'),
            ),
        ));
                
        
        $this->addColumn('products', array(
            'header' => Mage::helper('easybestsellers')->__('Show on products'),
            'align' => 'left',
            'type' => 'options',     
            'sortable' => false,
            'options' => Mage::getModel('easybestsellers/data')->getProducts4Form(),            
            'index' => 'products',
            'filter_condition_callback'  => array($this, '_filterProductCondition'),             
            'renderer' => 'easybestsellers/admin_item_grid_renderer_products'
        ));
        
        $this->addColumn('categories', array(
            'header' => Mage::helper('easybestsellers')->__('Show on categories'),
            'align' => 'left',
            'type' => 'options',
            'sortable' => false,
            'options' => Mage::getModel('easybestsellers/data')->getCategories4Grid(),            
            'index' => 'categories',
            'filter_condition_callback'  => array($this, '_filterCategoryCondition'),
            'renderer' => 'easybestsellers/admin_item_grid_renderer_categories'
        ));        
        
        $this->addColumn('pages', array(
            'header' => Mage::helper('easybestsellers')->__('Show on pages'),
            'align' => 'left',
            'type' => 'options',     
            'sortable' => false,
            'options' => Mage::getModel('easybestsellers/data')->getPages4Grid(),                
            'index' => 'products',
            'filter_condition_callback'  => array($this, '_filterPageCondition'),            
            'renderer' => 'easybestsellers/admin_item_grid_renderer_pages'
        ));   
        
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('easybestsellers')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'width'         => '120px',
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'  => array($this, '_filterStoreCondition'),
            ));
        }        

        if (Mage::getStoreConfig('easybestsellers/options/bigsize')) {         
            $this->addColumn('from_time', array(
                'header' => Mage::helper('easybestsellers')->__('From Time'),
                'index' => 'from_time',
                'type' => 'datetime',
            ));

            $this->addColumn('to_time', array(
                'header' => Mage::helper('easybestsellers')->__('To Time'),
                'index' => 'to_time',
                'type' => 'datetime',
            ));
        }
        $this->addColumn('is_active', array(
            'header' => Mage::helper('easybestsellers')->__('Status'),
            'index' => 'is_active',
            'type' => 'options',
            'options' => array(
                0 => Mage::helper('easybestsellers')->__('Disabled'),
                1 => Mage::helper('easybestsellers')->__('Enabled'),
            ),
        ));


        $this->addColumn('action',
                array(
                    'header' => Mage::helper('easybestsellers')->__('Action'),
                    'index' => 'item_id',
                    'sortable' => false,
                    'filter' => false,
                    'no_link' => true,
                    'width' => '100px',
                    'renderer' => 'easybestsellers/admin_item_grid_renderer_action'
        ));
//        $this->addExportType('*/*/exportCsv', Mage::helper('easybestsellers')->__('CSV'));
//        $this->addExportType('*/*/exportXml', Mage::helper('easybestsellers')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _afterLoadCollection() {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }

    protected function _filterCategoryCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addCategoryFilter($value);
    }
    protected function _filterProductCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addProductFilter($value);
    }
    protected function _filterPageCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addPageFilter($value);
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('item_id');
        $this->getMassactionBlock()->setFormFieldName('massaction');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('easybestsellers')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('easybestsellers')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('easybestsellers')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('easybestsellers')->__('Status'),
                    'values' => array(
                        0 => Mage::helper('easybestsellers')->__('Disabled'),
                        1 => Mage::helper('easybestsellers')->__('Enabled'),
                    ),
                )
            )
        ));
        
        $this->getMassactionBlock()->addItem('chekout', array(
            'label' => Mage::helper('easybestsellers')->__('Display on checkout page'),
            'url' => $this->getUrl('*/*/massCheckout', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'checkout',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('easybestsellers')->__('Display'),
                    'values' => array(
                        0 => Mage::helper('easybestsellers')->__('No'),
                        1 => Mage::helper('easybestsellers')->__('Yes'),
                    ),
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit',  array('item_id' => $row->getId(), 'type' => $row->getData('item_type')));
    }

}
