<?php
/**
 * AKS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   AKS
 * @package    AKS_Quickcontact
 * @author     AKS Development Team
 * @copyright  Copyright (c) 2013 AKS. (http://www.aksinfosyst.com)
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class AKS_Quickcontact_Block_Adminhtml_Quickcontact_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'quickcontact';
        $this->_controller = 'adminhtml_quickcontact';
        
//        $this->_updateButton('save', 'label', Mage::helper('quickcontact')->__('Save Message'));
        $this->_updateButton('delete', 'label', Mage::helper('quickcontact')->__('Delete Message'));
		$this->_removeButton('save');
                $this->_removeButton('reset');
//        $this->_addButton('saveandcontinue', array(
//            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
//            'onclick'   => 'saveAndContinueEdit()',
//            'class'     => 'save',
//        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('quickcontact_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'quickcontact_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'quickcontact_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('quickcontact_data') && Mage::registry('quickcontact_data')->getId() ) {
            return Mage::helper('quickcontact')->__("View message from '%s'", $this->htmlEscape(Mage::registry('quickcontact_data')->getName()));
        } else {
            return Mage::helper('quickcontact')->__('Add Message');
        }
    }
}