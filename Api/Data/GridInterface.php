<?php
namespace Magepow\Autorelated\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'entity_id';
    const TITLE = 'title';
    const PRODUCTS = 'products';
    const POSITION = 'position';
    const STORES = 'stores';
    const SLIDER = 'slider';
    const IS_ACTIVE = 'is_active';

   /**
    * Get EntityId.
    *
    * @return int
    */
    public function getEntityId();

   /**
    * Set EntityId.
    */
    public function setEntityId($entityId);

   /**
    * Get Title.
    *
    * @return varchar
    */
    public function getTitle();

   /**
    * Set Title.
    */
    public function setTitle($title);

   /**
    * Get Products.
    *
    * @return varchar
    */
    public function getProducts();

   /**
    * Set Products.
    */
    public function setProducts($products);

   /**
    * Get Position.
    *
    * @return varchar
    */
    public function getPosition();

   /**
    * Set Position.
    */
    public function setPosition($position);

   /**
    * Get Store.
    *
    * @return varchar
    */
    public function getStores();

   /**
    * Set Store.
    */
    public function setStores($stores);

   /**
    * Get Slider.
    *
    * @return varchar
    */
    public function getSlider();

   /**
    * Set Slider.
    */
    public function setSlider($slider);

    /**
    * Get IsActive.
    *
    * @return varchar
    */
    public function getIsActive();

   /**
    * Set IsActive.
    */
    public function setIsActive($isActive);

}
