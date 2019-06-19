# Quick-contact-Form-custom-captcha
Quick contact Form with custom captcha for Magento 1

We can get custom captcha for registration form 

// We can use below code for registraton form adding custom captcha
```
<div class="field">
    <label><?php echo $this->__('Captcha Code') ?></label>
    <input name="captacha_code" type="hidden" id="enquiry_code" value="<?php echo $code=Mage::helper('quickcontact')->getNewCode(6)?>" />
    <div class="sec-code"><del style="font-size: 24px; background: #212121; color: #FFF; padding: 4px 10px;"><?php echo $code ?></del></div>
    <label><?php echo $this->__('Enter Code') ?><span class="required"></span></label>
    <input id="security_enquiry_code" class="input-text required-entry" name="security_code" value="" >
    <div class="enquiry-recaptcha-error-msg"></div>
</div>
```
// add java below script in registration form
```
<script type="text/javascript">
    $j(document).ready(function(){
        $j('#send-btn_<?= $_product->getId();?>').on('click', function() {
        var captacha_code = $j("#enquiry_code").val();
        var security_code = $j("#security_enquiry_code").val();
          if(captacha_code != security_code) {
            $j('.enquiry-recaptcha-error-msg').html('Incorrect CAPTCHA.').css({'color':'red','float':'left','text-align':'center','width':'100%'});
            return false;
          } else {
            $j('.enquiry-recaptcha-error-msg').html('');
          }
        });
    });
</script> 
```
