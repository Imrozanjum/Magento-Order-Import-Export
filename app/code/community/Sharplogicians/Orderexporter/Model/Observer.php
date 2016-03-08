<?php
class Sharplogicians_Orderexporter_Model_Observer {
 
  public function exportall($observer)
	{
	 	$time = time();
		$to = date('Y-m-d H:i:s', $time);
		$minusTime = Mage::getStoreConfig('sharplogicians/orderexportcron/timevalue',Mage::app()->getStore());
		//Mage::log($minusTime);
		//$lastTime = $time - 86400; // 60*60*24
		$lastTime = $time - $minusTime;
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