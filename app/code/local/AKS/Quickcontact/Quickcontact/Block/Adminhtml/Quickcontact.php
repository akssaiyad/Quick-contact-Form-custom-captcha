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
class AKS_Quickcontact_Block_Adminhtml_Quickcontact extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_quickcontact';
    $this->_blockGroup = 'quickcontact';
    $this->_headerText = Mage::helper('quickcontact')->__('Messages');
    $this->_addButtonLabel = Mage::helper('quickcontact')->__('Add Message');

    parent::__construct();
    $this->_removeButton('add');
  }
}