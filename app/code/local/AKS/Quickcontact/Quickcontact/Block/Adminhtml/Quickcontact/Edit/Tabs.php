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
class AKS_Quickcontact_Block_Adminhtml_Quickcontact_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('quickcontact_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('quickcontact')->__('Message Detail'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('quickcontact')->__('Message Detail'),
          'title'     => Mage::helper('quickcontact')->__('Message Detail'),
          'content'   => $this->getLayout()->createBlock('quickcontact/adminhtml_quickcontact_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}