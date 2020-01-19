<?php
	/** ===============================================================================
		Plugin Name: Elochka REST
		Description: Плагин для работы с контентом магазина по средствам REST API.
		Version: 1.3.22
		Author: Mark Khramko
		================================================================================
	*/
	defined('ABSPATH') || exit;

	function receiveOrder($request){
		global $woocommerce;

		// Validate Phone number
		$phonenumber = $request['phonenumber'];
		if (!$phonenumber){
			return [
				'error' => [
					'description' => 'Please, provide "phonenumber" argument.'
				]
			];
		}

		$clientName = $request['name'];
		$clientInfo = array(
			'first_name' => $clientName,
			'phone' => $phonenumber
		);

		// Now we create the order
		$order = wc_create_order();

		$productId = $request['product_id'];
		if ($productId){
			// Add order with id in DB
			$order->add_product(get_product($productId), 1); 
		}

		// Add client info
		$order->set_address($clientInfo, 'billing');

		$order->calculate_totals();
		$order->update_status("processing");

		// Add message to note
		$message = $request['message'];
		if (!!$message){
			$order->add_order_note($message, true);
		}

		return [
			'error' => null,
			'order' => $order
		];
	}
	
	add_action('rest_api_init', function(){
		// Orders
		register_rest_route('v1', 'orders', array(
			'methods' => 'POST',
			'callback' => 'receiveOrder'
		));
	});
?>