<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Magazento_Easybestsellers_Block_Layout extends Mage_Core_Block_Template 
{ 
    protected function _construct() {
        $this->addData(array(
            'cache_lifetime' => 86400,
            'cache_tags' => array("magazento_easybestsellers_layout"),
        ));               
    }
    
    public function getCacheKeyInfo()
    {
        $identificator = $this->getData('entity_type').'_'.$this->getData('entity_id').'_'.$this->getData('entity_layout').'_'.$this->getData('entity_order');
        return array(
           'magazento_easybestsellers_layout',
           Mage::app()->getStore()->getId(),
           Mage::getDesign()->getPackageName(),
           Mage::getDesign()->getTheme('template'),
           $identificator
        );
    }    
    
    public function getCurrentLayoutItems($type,$_layout, $_order,$id,$store = 0) {
        return Mage::getModel('easybestsellers/item')->getLayoutItems($type,$_layout, $_order,$id,$store);
    }
    
}