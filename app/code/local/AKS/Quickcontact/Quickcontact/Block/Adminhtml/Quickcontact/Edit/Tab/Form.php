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
 * @copyright  Copyright (c) 2019 AKS. (http://www.aksinfosyst.com)
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class AKS_Quickcontact_Block_Adminhtml_Quickcontact_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('quickcontact_form', array('legend'=>Mage::helper('quickcontact')->__('Message detail')));
     
      $fieldset->addField('name', 'label', array(
          'label'     => Mage::helper('quickcontact')->__('Name'),
          'name'      => 'name',
      ));

      $fieldset->addField('email', 'label', array(
          'label'     => Mage::helper('quickcontact')->__('Email'),
          'name'      => 'email',
      ));
      
      $fieldset->addField('phone', 'label', array(
          'label'     => Mage::helper('quickcontact')->__('Phone No.'),
          'name'      => 'phone',
      ));
      
      $fieldset->addField('subject', 'label', array(
          'label'     => Mage::helper('quickcontact')->__('Subject'),
          'name'      => 'subject',
      ));
      
//      $fieldset->addField('message', 'label', array(
//          'label'     => Mage::helper('quickcontact')->__('Message'),
//          'name'      => 'message',
//      ));
		

     
      $fieldset->addField('message', 'editor', array(
          'name'      => 'message',
          'label'     => Mage::helper('quickcontact')->__('Message'),
          'title'     => Mage::helper('quickcontact')->__('Message'),
          'style'     => 'width:500px; height:350px',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getQuickcontactData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getQuickcontactData());
          Mage::getSingleton('adminhtml/session')->setQuickcontactData(null);
      } elseif ( Mage::registry('quickcontact_data') ) {
          $form->setValues(Mage::registry('quickcontact_data')->getData());
      }
      return parent::_prepareForm();
  }
}