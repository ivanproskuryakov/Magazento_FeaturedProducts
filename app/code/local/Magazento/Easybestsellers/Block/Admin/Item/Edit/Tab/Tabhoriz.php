<?php
/*
 *  Created on Dec 6, 2012
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Magazento_Easybestsellers_Block_Admin_Item_Edit_Tab_Tabhoriz extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('general_tab');
        $this->setDestElementId('easybestsellers_tabs_form_section_item_content');
        $this->setTemplate('widget/tabshoriz.phtml');
    }

    protected function _prepareLayout()
    {
        $this->addTab('content', array(
            'label'     => $this->__('Content'),
            'content'   => $this->getLayout()->createBlock('easybestsellers/admin_item_edit_tab_tabhoriz_content')->toHtml(),
            'active'    => true
        ));
        $this->addTab('reviews', array(
            'label'     => $this->__('Manual reviews'),
            'content'   => $this->getLayout()->createBlock('easybestsellers/admin_item_edit_tab_tabhoriz_reviews')->toHtml(),
            'active'    => true
        ));
        $this->addTab('assigned', array(
            'label'     => $this->__('Manual products'),
            'content'   => $this->getLayout()->createBlock('easybestsellers/admin_item_edit_tab_tabhoriz_assigned')->toHtml(),
            'active'    => true
        ));
        $this->addTab('form', array(
            'label'     => $this->__('General'),
            'content'   => $this->getLayout()->createBlock('easybestsellers/admin_item_edit_tab_tabhoriz_form')->toHtml(),
            'active'    => true
        ));            
        return parent::_prepareLayout();
    }
}