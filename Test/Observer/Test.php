<?php
namespace Sooryen\Test\Observer;

class Test implements \Magento\Framework\Event\ObserverInterface
{
  protected $_logger;
  protected $_testFactory;
  public function __construct(
  \Psr\Log\LoggerInterface $logger, //log injection
  \Sooryen\Test\Model\TestFactory $testFactory,
  array $data = []
  ) {
  $this->_logger = $logger;
  $this->_testFactory = $testFactory;
  //parent::__construct($data);
  }


  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    //Order id
    $order = $observer->getEvent()->getOrder();
    $order_id = $order->getIncrementId();

    //Get items
    $orderAllItems = $order->getAllVisibleItems();
    $orderItem = array();

    //Get customer id and names
    $customerId = $order->getCustomerId();
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $customerRepository = $objectManager->create(\Magento\Customer\Api\CustomerRepositoryInterface::class);
    $customer = $customerRepository->getById($customerId);
    if($customer->getId()){
        $customerFirst = $customer->getFirstname();
        $customerLast = $customer->getLastname();
    }
    
    //Post to DB
    foreach ($orderAllItems as $item) {
      $orderItem=array('quantity'=>$item->getQtyOrdered(),'sku'=>$item->getSku(),'name'=>$item->getName(),'price'=>$item->getPrice());
      $test = $this->_testFactory->create();
      $test->setProductName($orderItem['name']);
      $test->setSku($orderItem['sku']);
      $test->setQty($orderItem['quantity']);
      $test->setOrderId($order_id);
      $test->setCustomerId($customerId);
      $test->setFirstName($customerFirst);
      $test->setLastName($customerLast);
      $test->save();
    }
  }

}

