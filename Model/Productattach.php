<?php
namespace Magepow\Autorelated\Model;

class Productattach extends \Magento\Framework\Model\AbstractModel
{
    
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magepow\Autorelated\Model\ResourceModel\Grid');
    }
    
    public function getProducts(\Magepow\Autorelated\Model\Productattach $object)
    {
        $id = $object->getId();
        $tbl = $this->getResource()->getTable("magepow_autorelated");
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['products']
        )
        ->where(
            'entity_id = ?',
            (int)$id
        );

        $products = $this->getResource()->getConnection()->fetchCol($select);
        
        if ($products) {
            $products = explode('&', $products[0]);
        }

        return $products;
    }
}