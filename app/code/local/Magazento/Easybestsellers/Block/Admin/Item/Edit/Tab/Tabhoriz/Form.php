<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Admin_Item_Edit_Tab_Tabhoriz_Form extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $model = Mage::registry('easybestsellers_item');
        
        $form = new Varien_Data_Form(array('id' => 'edit_form_item', 'action' => $this->getData('action'), 'method' => 'post'));
        $form->setHtmlIdPrefix('item_');
        
        

        


        $fieldset = $form->addFieldset('base_fieldset_automation', array('legend' => Mage::helper('easybestsellers')->__('Automation settings'), 'class' => 'fieldset-wide'));
        $fieldset->addField('bestseller_type', 'select', array(
            'name' => 'bestseller_type',
            'label' => Mage::helper('easybestsellers')->__('Bestseller type'),
            'title' => Mage::helper('easybestsellers')->__('Bestseller type'),
            'required' => true,
            'options' => Mage::helper('easybestsellers/data')->getTypes(),
        ));  
        $fieldset->addField('count', 'text', array(
            'name' => 'count',
            'label' => Mage::helper('easybestsellers')->__('Items count'),
            'title' => Mage::helper('easybestsellers')->__('Items count'),
            'required' => true,
        ));        
        $fieldset->addField('colcount', 'text', array(
            'name' => 'colcount',
            'label' => Mage::helper('easybestsellers')->__('Items in row(Columns)'),
            'title' => Mage::helper('easybestsellers')->__('Items in row(Columns)'),
            'required' => true,
        ));                
        $fieldset->addField('bestsellercategory', 'text', array(
            'name' => 'bestsellercategory',
            'label' => Mage::helper('easybestsellers')->__('Bestseller category ID' ),
            'title' => Mage::helper('easybestsellers')->__('Bestseller category ID'),
            'required' => false,
            'note' => 'Easybestsellers will filter items by category ID<br/> "0" = no filter',
        ));             
        
        
        
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('easybestsellers')->__('Display settings'), 'class' => 'fieldset-wide'));
        if ($model->getItemId()) {
            $fieldset->addField('item_id', 'hidden', array(
                'name' => 'item_id',
            ));
        }
        
        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('easybestsellers')->__('Title'),
            'title' => Mage::helper('easybestsellers')->__('Title'),
            'required' => true,
        ));
        
        $fieldset->addField('layout', 'select', array(
            'name' => 'layout',
            'label' => Mage::helper('easybestsellers')->__('Layout block'),
            'title' => Mage::helper('easybestsellers')->__('Layout block'),
            'required' => true,
            'options' => Mage::helper('easybestsellers/data')->getLayoutTypes(),
        ));    
        $fieldset->addField('order', 'select', array(
            'name' => 'order',
            'label' => Mage::helper('easybestsellers')->__('Block order'),
            'title' => Mage::helper('easybestsellers')->__('Block order'),
            'required' => true,
            'options' => Mage::helper('easybestsellers/data')->getLayoutOrder(),
        ));    
        
        $fieldset->addField('position', 'select', array(
            'name' => 'position',
            'label' => Mage::helper('easybestsellers')->__('Position(Sorting)'),
            'title' => Mage::helper('easybestsellers')->__('Position(Sorting)'),
            'required' => true,
            'options' => Mage::helper('easybestsellers')->numberArray(20,Mage::helper('easybestsellers')->__('')),
        ));
        
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('easybestsellers')->__('Store View'),
                'title' => Mage::helper('easybestsellers')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            'style' => 'height:150px',
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField('is_active', 'select', array(
            'label' => Mage::helper('easybestsellers')->__('Status'),
            'title' => Mage::helper('easybestsellers')->__('Status'),
            'name' => 'is_active',
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('Disabled'),
                '1' => Mage::helper('easybestsellers')->__('Enabled'),                
            ),
        ));
        $fieldset->addField('display_type', 'select', array(
            'name' => 'display_type',
            'label' => Mage::helper('easybestsellers')->__('Display type'),
            'title' => Mage::helper('easybestsellers')->__('Display type'),
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('Grid'),
                '1' => Mage::helper('easybestsellers')->__('Slider'),                
            ),
        ));            

        $fieldset->addField('on_checkout', 'select', array(
            'label' => Mage::helper('easybestsellers')->__('Display on checkout page'),
            'title' => Mage::helper('easybestsellers')->__('Display on checkout page'),
            'name' => 'on_checkout',
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('No'),
                '1' => Mage::helper('easybestsellers')->__('Yes'),                
            ),
        ));
        
        
        $fieldset->addField('assign_products', 'select', array(
            'label' => Mage::helper('easybestsellers')->__('Display on product pages'),
            'title' => Mage::helper('easybestsellers')->__('Display on product pages'),
            'name' => 'assign_products',
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('Dispaly on selected products'),
                '1' => Mage::helper('easybestsellers')->__('All products'),
            ),
        ));
        $fieldset->addField('assign_categories', 'select', array(
            'label' => Mage::helper('easybestsellers')->__('Display on category pages'),
            'title' => Mage::helper('easybestsellers')->__('Display on category pages'),
            'name' => 'assign_categories',
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('Dispaly on selected categories'),
                '1' => Mage::helper('easybestsellers')->__('All categories'),
            ),
        ));
        $fieldset->addField('assign_pages', 'select', array(
            'label' => Mage::helper('easybestsellers')->__('Display on CMS pages'),
            'title' => Mage::helper('easybestsellers')->__('Display on CMS pages'),
            'name' => 'assign_pages',
            'required' => true,
            'options' => array(
                '0' => Mage::helper('easybestsellers')->__('Dispaly on selected pages'),
                '1' => Mage::helper('easybestsellers')->__('All pages'),
            ),
        ));

        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $fieldset->addField('from_time', 'date', array(
            'name' => 'from_time',
            'time' => true,
            'label' => Mage::helper('easybestsellers')->__('From Time'),
            'title' => Mage::helper('easybestsellers')->__('From Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'style' => 'width:272px',
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));

        $fieldset->addField('to_time', 'date', array(
            'name' => 'to_time',
            'time' => true,
            'label' => Mage::helper('easybestsellers')->__('To Time'),
            'title' => Mage::helper('easybestsellers')->__('To Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'style' => 'width:272px',
            'format' => $dateFormatIso,
        ));
        

        $fieldset->addField('script_java', 'note', array(
            'text' => '<script type="text/javascript">
				            var inputDateFrom = document.getElementById(\'item_from_time\');
				            var inputDateTo = document.getElementById(\'item_to_time\');
            				inputDateTo.onchange=function(){dateTestAnterior(this)};
				            inputDateFrom.onchange=function(){dateTestAnterior(this)};


				            function dateTestAnterior(inputChanged){
				            	dateFromStr=inputDateFrom.value;
				            	dateToStr=inputDateTo.value;

				            	if(dateFromStr.indexOf(\'.\')==-1)
				            		dateFromStr=dateFromStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");
				            	if(dateToStr.indexOf(\'.\')==-1)
				            		dateToStr=dateToStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");

				            	fromDate= Date.parseDate(dateFromStr,"%e %b %Y %H:%M:%S");
				            	toDate= Date.parseDate(dateToStr,"%e %b %Y %H:%M:%S");

				            	if(dateToStr!=\'\'){
					            	if(fromDate>toDate){
	            						inputChanged.value=\'\';
	            						alert(\'' . Mage::helper('easybestsellers')->__('You must set a date to value greater than the date from value') . '\');
					            	}
				            	}
            				}
            			</script>',
            'disabled' => true
        ));
        

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
