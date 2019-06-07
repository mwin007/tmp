<?php

namespace Sooryen\Test\Block\Index;


class Index extends \Magento\Framework\View\Element\Template {

    protected $_testFactory;
    public function __construct(
    	\Magento\Catalog\Block\Product\Context $context,
    	\Sooryen\Test\Model\TestFactory $testFactory,
    	array $data = []
    ) 
    {

        $this->_testFactory = $testFactory;
        parent::__construct($context, $data);

    }


    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function sayHello()
	{
		return __('Hello World');
	}

    public function getTestCollection(){
		$test = $this->_testFactory->create();
		return $test->getCollection();
	}

}
