<?php
class Sharplogicians_Orderexporter_Model_Observer {
 
  public function exportall($observer)
	{
	 	$time = time();
		$to = date('Y-m-d H:i:s', $time);
		$lastTime = $time - 86400; // 60*60*24
		$from = date('Y-m-d H:i:s', $lastTime);
	  	$orders = Mage::getModel('sales/order')->getCollection()
		->addAttributeToSelect('entity_id')
		->addAttributeToSelect('created_at')
  		->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to));
		$order_arr = array();
	

		foreach ($orders as $order)  {
				$order_arr[] = $order->getId();
		}
		$file = Mage::getModel('exporter/nxportorders')->exportOrders($order_arr);

	}
    
 
	}

?>