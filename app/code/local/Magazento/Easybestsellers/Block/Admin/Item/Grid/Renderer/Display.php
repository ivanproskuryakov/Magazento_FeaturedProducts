<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Magazento_Easybestsellers_Block_Admin_Item_Grid_Renderer_Display extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{

  public function render(Varien_Object $row)
    {
        $html = '';
        if (!$row->getData('assign_categories')) $html.=Mage::helper('easybestsellers')->__('All categories').'<br />';
        if ($row->getData('assign_categories'))  $html.=Mage::helper('easybestsellers')->__('Assigned categories').'<br />';
        
        if (!$row->getData('assign_pages')) $html.=Mage::helper('easybestsellers')->__('All pages').'<br />';
        if ($row->getData('assign_pages'))  $html.=Mage::helper('easybestsellers')->__('Assigned pages').'<br />';
        
        if (!$row->getData('assign_products')) $html.=Mage::helper('easybestsellers')->__('All products').'<br />';
        if ($row->getData('assign_products'))  $html.=Mage::helper('easybestsellers')->__('Assigned products').'<br />';
        return $html;
    }    
}
