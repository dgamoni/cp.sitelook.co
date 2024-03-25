<?php 

add_shortcode( 'set_patient_card', 'set_patient_card_func' );
function set_patient_card_func( $atts ){  


//create_card_patient();
//get_card_patient();
	//charge_patient();



	ob_start();
	?>



<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" class="patient_billing_setup">
  <input type="hidden" name="cmd" value="_s-xclick">
  
 <!--  <input type="hidden" name="notify_url"     value="http://cp.sitelook.co/patient-home/set-patient-card/">
  <input type="hidden" name="return"         value="http://cp.sitelook.co/patient-home/set-patient-card/" />
  <input type="hidden" name="cancel_return"  value="http://cp.sitelook.co/patient-home/set-patient-card/" /> -->

  <input type="hidden" name="hosted_button_id" value="TZKGSUSVRDB5E">
  
  <div class="acf-field acf-field-text" data-width="50">
    <div class="acf-label">
      <label>Enter the maximum amount you want to pay each month (USD)</label>
      <label>You can be billed up to $0.01USD</label>
    </div>
    <input type="text" name="max_amount" value="">
    
    <div class="acf-label sign_label">
        <label>Sign up for</label>
    </div>

    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_auto_billing_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
  </div>  

  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



	<?php
	$out .= ob_get_contents();
	ob_end_clean();

	return $out;
}	

function charge_patient() {
	
	$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        // 'AWNzOo0WZvjL7Xb4qLl5fumbxGUXg9Mf18fghxmxSFXuAg8b9zgbMart3OBM0E2nWAWnSrLTLKYp5s4f',     // ClientID
        // 'EI2Fi02Pqis4gfUcz0BIgm-ykPCinS-rvQeWEL79ERL9bPdi1mYq794pUXVpc8IW28AINpGZ96tz4zDL'      // ClientSecret
        )
    );
    $apiContext->setConfig(
      array(
          'log.LogEnabled' => true,
          'log.FileName' => 'PayPal.log',
          'log.LogLevel' => 'DEBUG'
              )
        );

	$amount = new \PayPal\Api\Amount();
	$amount->setCurrency("USD")->setTotal('39');
	$charge = new \PayPal\Api\ChargeModel();
	$charge->setType('Appointment')->setamount($amount);
}

function get_card_patient()  {

	$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        // 'AWNzOo0WZvjL7Xb4qLl5fumbxGUXg9Mf18fghxmxSFXuAg8b9zgbMart3OBM0E2nWAWnSrLTLKYp5s4f',     // ClientID
        // 'EI2Fi02Pqis4gfUcz0BIgm-ykPCinS-rvQeWEL79ERL9bPdi1mYq794pUXVpc8IW28AINpGZ96tz4zDL'      // ClientSecret
        )
    );
    $apiContext->setConfig(
      array(
          'log.LogEnabled' => true,
          'log.FileName' => 'PayPal.log',
          'log.LogLevel' => 'DEBUG'
              )
        );

	$card1 = new \PayPal\Api\CreditCard();
	$card1->get("CARD-5M459096EC088300FLPEGHYY",$apiContext);
	$response = $card1->get("CARD-5M459096EC088300FLPEGHYY",$apiContext);
 	echo "<pre>"; print_r($response);
}

function create_card_patient() {

	$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        // 'AWNzOo0WZvjL7Xb4qLl5fumbxGUXg9Mf18fghxmxSFXuAg8b9zgbMart3OBM0E2nWAWnSrLTLKYp5s4f',     // ClientID
        // 'EI2Fi02Pqis4gfUcz0BIgm-ykPCinS-rvQeWEL79ERL9bPdi1mYq794pUXVpc8IW28AINpGZ96tz4zDL'      // ClientSecret
        'AZVENOIt23i55t9u9oMOqSwfrWuWVqgRMyHfrwaD_vpsfKbsZGVOVvZThPF2h1jBvjGJjJQ-NIwQQnoC',
        'EBfSkrxCGr354FnHklelawSF3KVsLXoB6eANu1j84JT8UXWmXiJFBQ8MP-Vi4-dZ4gx22L0_Tq56ySJx'
        )
    );
    $apiContext->setConfig(
      array(
          'log.LogEnabled' => true,
          'log.FileName' => 'PayPal.log',
          'log.LogLevel' => 'DEBUG'
              )
        );
    $card = new \PayPal\Api\CreditCard();
    $card->setNumber('4032032476376683');
    $card->setType('visa');
    $card->setExpireMonth(2);
    $card->setExpireYear(2023);
    $card->setCvv2('123');
    $card->setFirstName('Farhan');
    $card->setLastName('Khan');

     try {
        $card->create($apiContext);
        echo "<pre>"; print_r($card);

    }
    catch (\PayPal\Exception\PayPalConnectionException $ex) {
        echo "error";
        echo $ex->getData();

 }

}



// PayPal\Api\CreditCard Object
// (
//     [_propMap:PayPal\Common\PayPalModel:private] => Array
//         (
//             [number] => xxxxxxxxxxxx6683
//             [type] => visa
//             [expire_month] => 2
//             [expire_year] => 2023
//             [cvv2] => 123
//             [first_name] => Farhan
//             [last_name] => Khan
//             [id] => CARD-5M459096EC088300FLPEGHYY
//             [state] => ok
//             [valid_until] => 2021-10-17T00:00:00Z
//             [create_time] => 2018-10-18T10:43:47Z
//             [update_time] => 2018-10-18T10:43:47Z
//             [links] => Array
//                 (
//                     [0] => PayPal\Api\Links Object
//                         (
//                             [_propMap:PayPal\Common\PayPalModel:private] => Array
//                                 (
//                                     [href] => https://api.sandbox.paypal.com/v1/vault/credit-cards/CARD-5M459096EC088300FLPEGHYY
//                                     [rel] => self
//                                     [method] => GET
//                                 )

//                         )

//                     [1] => PayPal\Api\Links Object
//                         (
//                             [_propMap:PayPal\Common\PayPalModel:private] => Array
//                                 (
//                                     [href] => https://api.sandbox.paypal.com/v1/vault/credit-cards/CARD-5M459096EC088300FLPEGHYY
//                                     [rel] => delete
//                                     [method] => DELETE
//                                 )

//                         )

//                     [2] => PayPal\Api\Links Object
//                         (
//                             [_propMap:PayPal\Common\PayPalModel:private] => Array
//                                 (
//                                     [href] => https://api.sandbox.paypal.com/v1/vault/credit-cards/CARD-5M459096EC088300FLPEGHYY
//                                     [rel] => patch
//                                     [method] => PATCH
//                                 )

//                         )

//                 )

//         )

// )