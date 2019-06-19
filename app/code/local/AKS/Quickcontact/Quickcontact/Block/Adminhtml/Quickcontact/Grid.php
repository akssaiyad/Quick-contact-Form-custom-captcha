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
class AKS_Quickcontact_Block_Adminhtml_Quickcontact_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('quickcontactGrid');
      $this->setDefaultSort('quickcontact_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('quickcontact/quickcontact')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('qc_id', array(
          'header'    => Mage::helper('quickcontact')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'qc_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('quickcontact')->__('name'),
          'align'     =>'left',
          'index'     => 'name',
      ));
      
      $this->addColumn('email', array(
          'header'    => Mage::helper('quickcontact')->__('email'),
          'align'     =>'left',
          'index'     => 'email',
      ));
      
      $this->addColumn('phone', array(
          'header'    => Mage::helper('quickcontact')->__('phone'),
          'align'     =>'left',
          'index'     => 'phone',
      ));
      
      $this->addColumn('subject', array(
          'header'    => Mage::helper('quickcontact')->__('Subject'),
          'align'     =>'left',
          'index'     => 'subject',
      ));
      
      $this->addColumn('created_time', array(
          'header'    => Mage::helper('quickcontact')->__('Time Created'),
          'align'     =>'left',
          'type'      => 'datetime',
          'index'     => 'created_time',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('quickcontact')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('quickcontact')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('quickcontact')->__('View'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('quickcontact')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('quickcontact')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('quickcontact_id');
        $this->getMassactionBlock()->setFormFieldName('quickcontact');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('quickcontact')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('quickcontact')->__('Are you sure?')
        ));

//        $statuses = Mage::getSingleton('quickcontact/status')->getOptionArray();
//
//        array_unshift($statuses, array('label'=>'', 'value'=>''));
//        $this->getMassactionBlock()->addItem('status', array(
//             'label'=> Mage::helper('quickcontact')->__('Change status'),
//             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
//             'additional' => array(
//                    'visibility' => array(
//                         'name' => 'status',
//                         'type' => 'select',
//                         'class' => 'required-entry',
//                         'label' => Mage::helper('quickcontact')->__('Status'),
//                         'values' => $statuses
//                     )
//             )
//        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}