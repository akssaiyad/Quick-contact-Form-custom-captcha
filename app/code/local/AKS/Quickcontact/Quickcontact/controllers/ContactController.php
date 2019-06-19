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
class AKS_Quickcontact_ContactController extends Mage_Core_Controller_Front_Action
{
    public function formAction()
    {
		$this->loadLayout();     
		$this->renderLayout();
    }
    
    public function submitAction() {
        if ($data = $this->getRequest()->getPost()) {
            
            $saved = false;
            $emailed = false;
            
            $isEmailEnabled = Mage::getStoreConfig('quickcontact/general/send_email');
            $recipient_email = Mage::getStoreConfig('quickcontact/general/recipient_email');
            if($recipient_email)
                $email_added = true;
            else $email_added = false;
            
            $save_enabled = Mage::getStoreConfig('quickcontact/general/enable_save');
            
            //if none is enabled
            if($isEmailEnabled == 1 || $save_enabled == 1)
            {
            
            $captchaerror = false;
            
            if (!Zend_Validate::is(trim($data['security_code']) , 'NotEmpty')) { 
                $captchaerror = true;
            }
            //++++++ CAPTCHA validation ++++++++++++++
            $translate = Mage::getSingleton('core/translate');
            $translate->setTranslateInline(false);
            
            if (!$captchaerror && strtolower($data['security_code'])!= $data['captacha_code']) {
                $translate->setTranslateInline(true);
                Mage::getSingleton('core/session')->addError("The CAPTCHA you entered was incorrrect.");
                     Mage::getSingleton('core/session')->setQuickFormData($data);
                     
                     $this->_redirectReferer();
                    return;
            }
            
            
            
            //+++++++++ Save to Database enabled +++++++++
            $isSaveEnabled = Mage::getStoreConfig('quickcontact/general/enable_save');
            if($isSaveEnabled){
               	$model = Mage::getModel('quickcontact/quickcontact');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
            try {
                    $model->setCreatedTime(now());

                    $model->save();
                    
                    $emailed = true;
//                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('quickcontact')->__('Message was successfully saved'));
//                    Mage::getSingleton('adminhtml/session')->setFormData(false);
//
//                    $this->_redirect('*/*/');
//                    return;
                } catch (Exception $e) {
//                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
//                    Mage::getSingleton('adminhtml/session')->setFormData($data);
//                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
//                    return;
                }
            }//if save to DB
/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/            
            
            if($isEmailEnabled && $email_added)
            {
        try {
            $emailTemplate  = Mage::getModel('core/email_template')
                        ->loadDefault('quick_contact_email');                                

            $sender_name = $data['name'];

            $recipient_name = Mage::getStoreConfig('quickcontact/general/recipient_name');
            $recipient_email = Mage::getStoreConfig('quickcontact/general/recipient_email');
            //$recipient_email = 'support@aksinfosyst.com';
            
            $sender_email = $data['email'];
            //Create an array of variables to assign to template
            $emailTemplateVariables = array();

            $emailTemplateVariables['sender_name'] = $data['name'];
            $emailTemplateVariables['sender_email'] = $data['email'];
            $emailTemplateVariables['email_subject'] = $data['subject'];
            $emailTemplateVariables['phone'] = $data['phone'];
            $emailTemplateVariables['message'] = $data['message'];

            $processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);

            $email_subject = $data['subject'];
            /*
             * Or you can send the email directly,
             * note getProcessedTemplate is called inside send()
             */
            $emailTemplate->setSenderName($sender_name);
            $emailTemplate->setSenderEmail($sender_email);
            $emailTemplate->setTemplateSubject($email_subject);
            $emailTemplate->send($recipient_email, $recipient_name, $emailTemplateVariables);

            $emailed = true;
            
            } catch(Exception $e) {
                Mage::getSingleton('core/session')->addError(Mage::helper('quickcontact')->__('Unable to send message at this time. Please, try later.'));
                $this->_redirectReferer();
                return;
            }
            }//if email enabled
            
            if($saved || $emailed)
            {
            $success_message = Mage::getStoreConfig('quickcontact/general/success_message');
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('quickcontact')->__($success_message));
            $this->_redirectReferer();
            return;
            }
            
        }//service unavailable
        else { 
                $disabled_message = Mage::getStoreConfig('quickcontact/general/email_disabled_message');
                if(!$disabled_message)
                {$disabled_message = 'The service is unavailable at the moment please try again later';}
                Mage::getSingleton('core/session')->addError(Mage::helper('quickcontact')->__($disabled_message));
                $this->_redirectReferer();
                return;
            }
            
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('quickcontact')->__('Unable to send message.'));
        $this->_redirectReferer();
        
    }
}