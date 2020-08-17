<?php
namespace Magepow\Autorelated\Model\ResourceModel\Related;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'related_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Magepow\Autorelated\Model\Related',
            'Magepow\Autorelated\Model\ResourceModel\Related'
        );
    }
}
