<?php

namespace Magepow\Autorelated\Block;

Class Related extends \Magento\Framework\View\Element\Template
{
	protected $gridFactory;

	protected $_productCollectionFactory;
	
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magepow\Autorelated\Model\GridFactory $gridFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
	){
		parent::__construct($context);
		$this->gridFactory = $gridFactory;
		$this->_productCollectionFactory = $productCollectionFactory;
	}
	
	public function getProductPage()
	{	
		$collection = $this->gridFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',3);
	
		return $collection;
	}	

	public function getCartPage()
	{	
		$collection = $this->gridFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',2);
	
		return $collection;
	}	

	public function getHomePage()
	{	
		$collection = $this->gridFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',1);
	
		return $collection;
	}	

	public function getCategoryPage()
	{	
		$collection = $this->gridFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',0);
	
		return $collection;
	}

	public function getProductCollection($productId)
	{
		 // Ids=array(1,2,3);
		 $collection = $this->_productCollectionFactory->create();
		 $collection->addAttributeToSelect('*');   //semicolon is missing                  
		 $collection->addFieldToFilter('entity_id', ['in' => $productId]);
		 return $collection;
	}

	// public function getLoadProduct($arrayId)
	// {
	// 	$collection = $this->getCollection()->addFieldToFilter('product', array('in' => $arrayId));
	// }
}