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
class AKS_Quickcontact_Block_Form extends Mage_Core_Block_Template
{
    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('head')->addCss('css/quickcontact/quickcontact_default.css');
        return parent::_prepareLayout();
    }
    
     public function getQuickcontact()     
     { 
        if (!$this->hasData('quickcontact')) {
            $this->setData('quickcontact', Mage::registry('quickcontact'));
        }
        return $this->getData('quickcontact');
     }
}