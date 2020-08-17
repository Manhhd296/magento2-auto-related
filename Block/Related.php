<?php
namespace Magepow\Autorelated\Block;

Class Related extends \Magento\Framework\View\Element\Template
{
	protected $relatedFactory;

	protected $_productCollectionFactory;

	protected $_request;

	/**
     * @var ReviewRendererInterface
     */
    protected $reviewRenderer;

    /**
     * @var ImageBuilder
     * @since 102.0.0
     */
    protected $imageBuilder;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;


	
	public function __construct(
		// \Magento\Framework\View\Element\Template\Context $context,
		\Magepow\Autorelated\Model\RelatedFactory $relatedFactory,
		\Magento\Catalog\Block\Product\ListProduct $listProductBlock,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\Magento\Framework\App\Request\Http $request,
		\Magento\Catalog\Block\Product\Context $context,
		array $data = []
	){
		$this->relatedFactory = $relatedFactory;
		$this->listProductBlock = $listProductBlock;
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_request = $request;
		$this->reviewRenderer = $context->getReviewRenderer();
        $this->imageBuilder = $context->getImageBuilder();
        $this->_coreRegistry = $context->getRegistry();
		parent::__construct($context, $data);
	}


	public function getRelated($position)
	{	
		$collection = $this->relatedFactory->create()->getCollection();
		// $collection->addFieldToFilter('is_active',1);
		$collection->addFieldToFilter('position',$position);
	
		return $collection;
	}	

	public function getProductCollection($productId)
	{
		 $collection = $this->_productCollectionFactory->create();
		 $collection->addAttributeToSelect('*');             
		 $collection->addFieldToFilter('entity_id', ['in' => $productId]);
         $collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
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


        /**
     * Retrieve currently viewed product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (!$this->hasData('product')) {
            $this->setData('product', $this->_coreRegistry->registry('product'));
        }
        return $this->getData('product');
    }

    /**
     * Retrieve product details html
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return mixed
     */
    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        if ($renderer) {
            $renderer->setProduct($product);
            return $renderer->toHtml();
        }
        return '';
    }

    /**
     * Get the renderer that will be used to render the details block
     *
     * @param string|null $type
     * @return bool|\Magento\Framework\View\Element\AbstractBlock
     */
    public function getDetailsRenderer($type = null)
    {
        if ($type === null) {
            $type = 'default';
        }
        $rendererList = $this->getDetailsRendererList();
        if ($rendererList) {
            return $rendererList->getRenderer($type, 'default');
        }
        return null;
    }

    /**
     * Return the list of details
     *
     * @return \Magento\Framework\View\Element\RendererList
     */
    protected function getDetailsRendererList()
    {
        return $this->getDetailsRendererListName() ? $this->getLayout()->getBlock(
            $this->getDetailsRendererListName()
        ) : $this->getChildBlock(
            'details.renderers'
        );
    }

        /**
     * Get product reviews summary
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param bool $templateType
     * @param bool $displayIfNoReviews
     * @return string
     */
    public function getReviewsSummaryHtml(
        \Magento\Catalog\Model\Product $product,
        $templateType = false,
        $displayIfNoReviews = false
    ) {
        return $this->reviewRenderer->getReviewsSummaryHtml($product, $templateType, $displayIfNoReviews);
    }

    /**
     * Retrieve product image
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param array $attributes
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->imageBuilder->create($product, $imageId, $attributes);
    }


    /**
     * Retrieve Product URL using UrlDataObject
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param array $additional the route params
     * @return string
     */
    public function getProductUrl($product, $additional = [])
    {
        if ($this->hasProductUrl($product)) {
            if (!isset($additional['_escape'])) {
                $additional['_escape'] = true;
            }
            return $product->getUrlModel()->getUrl($product, $additional);
        }

        return '#';
    }

    /**
     * Check Product has URL
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return bool
     */
    public function hasProductUrl($product)
    {
        if ($product->getVisibleInSiteVisibilities()) {
            return true;
        }
        if ($product->hasUrlDataObject()) {
            if (in_array($product->hasUrlDataObject()->getVisibility(), $product->getVisibleInSiteVisibilities())) {
                return true;
            }
        }

        return false;
    }

}