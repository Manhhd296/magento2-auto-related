<?php
namespace Magepow\Autorelated\Block;

Class Related extends \Magento\Framework\View\Element\Template
{
	protected $gridFactory;

	protected $_productCollectionFactory;

	protected $_request;

	
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magepow\Autorelated\Model\GridFactory $gridFactory,
		\Magento\Catalog\Block\Product\ListProduct $listProductBlock,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\Magento\Framework\App\Request\Http $request
	){
		parent::__construct($context);
		$this->gridFactory = $gridFactory;
		$this->listProductBlock = $listProductBlock;
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_request = $request;
	}


	public function getRelated($position)
	{	
		$collection = $this->gridFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',$position);
	
		return $collection;
	}	

	public function getProductCollection($productId)
	{
		 $collection = $this->_productCollectionFactory->create();
		 $collection->addAttributeToSelect('*');             
		 $collection->addFieldToFilter('entity_id', ['in' => $productId]);
		 return $collection;
	}

	public function getAddToCartPostParams($product)
	{
	    return $this->listProductBlock->getAddToCartPostParams($product);
	}


    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        return $this->getProductPriceHtml(
            $product,
            \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE,
            \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST
        );
    }  

    public function getProductPriceHtml(
        \Magento\Catalog\Model\Product $product,
        $priceType,
        $renderZone = \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST,
        array $arguments = []
    ) {
        if (!isset($arguments['zone'])) {
            $arguments['zone'] = $renderZone;
        }

        /** @var \Magento\Framework\Pricing\Render $priceRender */
        $priceRender = $this->getLayout()->getBlock('product.price.render.default');
        $price = '';

        if ($priceRender) {
            $price = $priceRender->render($priceType, $product, $arguments);
        }
        return $price;
    }


	public function isPage($page)
	{

	    if ($this->_request->getFullActionName() == $page) {
	        return true;
	    }
	    return false;
	}	
}