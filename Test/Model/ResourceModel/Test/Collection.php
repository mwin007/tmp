<?php

namespace Sooryen\Test\Model\ResourceModel\Test;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Sooryen\Test\Model\Test', 'Sooryen\Test\Model\ResourceModel\Test');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>