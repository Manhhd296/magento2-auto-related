<?php
namespace Magepow\Autorelated\Model;

use Magepow\Autorelated\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'magepow_autorelated';

    /**
     * @var string
     */
    protected $_cacheTag = 'magepow_autorelated';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'magepow_autorelated';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Magepow\Autorelated\Model\ResourceModel\Grid');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Products.
     *
     * @return varchar
     */
    public function getProducts()
    {
        return $this->getData(self::PRODUCTS);
    }

    /**
     * Set Products.
     */
    public function setProducts($products)
    {
        return $this->setData(self::PRODUCTS, $products);
    }

    /**
     * Get getPosition.
     *
     * @return varchar
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * Set Position.
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Get Stores.
     *
     * @return varchar
     */
    public function getStores()
    {
        return $this->getData(self::STORES);
    }

    /**
     * Set Stores.
     */
    public function setStores($stores)
    {
        return $this->setData(self::STORES, $stores);
    }

    /**
     * Get Slider.
     *
     * @return varchar
     */
    public function getSlider()
    {
        return $this->getData(self::SLIDER);
    }

    /**
     * Set Slider.
     */
    public function setSlider($slider)
    {
        return $this->setData(self::SLIDER, $slider);
    }    

    /**
     * Get Cart.
     *
     * @return varchar
     */
    public function getCart()
    {
        return $this->getData(self::CART);
    }

    /**
     * Set Cart.
     */
    public function setCart($cart)
    {
        return $this->setData(self::CART, $cart);
    }    

    /**
     * Get Compare.
     *
     * @return varchar
     */
    public function getCompare()
    {
        return $this->getData(self::COMPARE);
    }

    /**
     * Set Compare.
     */
    public function setCompare($compare)
    {
        return $this->setData(self::COMPARE, $compare);
    }    

    /**
     * Get Wishlist.
     *
     * @return varchar
     */
    public function getWishlist()
    {
        return $this->getData(self::WISHLIST);
    }

    /**
     * Set Wishlist.
     */
    public function setWishlist($wishlist)
    {
        return $this->setData(self::WISHLIST, $wishlist);
    }    

    /**
     * Get Review.
     *
     * @return varchar
     */
    public function getReview()
    {
        return $this->getData(self::REVIEW);
    }

    /**
     * Set Review.
     */
    public function setReview($review)
    {
        return $this->setData(self::REVIEW, $review);
    }

    /**
     * Get IsActive.
     *
     * @return varchar
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
}
