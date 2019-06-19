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
class AKS_Quickcontact_Model_Mysql4_Quickcontact extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the quickcontact_id refers to the key field in your database table.
        $this->_init('quickcontact/quickcontact', 'qc_id');
    }
}