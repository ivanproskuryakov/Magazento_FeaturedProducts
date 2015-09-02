<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Admin_Item_Edit_Tab_Tabhoriz_Content extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $model = Mage::registry('easybestsellers_item');
        
        $form = new Varien_Data_Form(array('id' => 'edit_form_item_content', 'action' => $this->getData('action'), 'method' => 'post'));
        
        if (Mage::helper('easybestsellers')->versionUseWysiwig()) {
            $wysiwygConfig = Mage::getSingleton('easybestsellers/wysiwyg_config')->getConfig();
        } else {
            $wysiwygConfig = '';
        }

        $fieldset = $form->addFieldset('base_fieldset_content', array('legend' => Mage::helper('easybestsellers')->__('Content Information'), 'class' => 'fieldset-wide'));        
        $fieldset->addField('content_top', 'editor', array(
            'name' => 'content_top',
            'label' => Mage::helper('easybestsellers')->__('Content Top'),
            'title' => Mage::helper('easybestsellers')->__('Content Top'),
            'style' => 'height:16em',
            'config' => $wysiwygConfig,
            'required' => false,
        ));
        $fieldset->addField('content_bottom', 'editor', array(
            'name' => 'content_bottom',
            'label' => Mage::helper('easybestsellers')->__('Content Bottom'),
            'title' => Mage::helper('easybestsellers')->__('Content Bottom'),
            'style' => 'height:16em',
            'config' => $wysiwygConfig,
            'required' => false,
        ));


        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
