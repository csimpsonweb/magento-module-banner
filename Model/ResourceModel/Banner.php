<?php

namespace Maximuspoder\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Banner extends AbstractDb
{
    const BANNER_TABLE = 'maximuspoder_banners';

    protected function _construct()
    {
        $this->_init(self::BANNER_TABLE, 'id');
    }
}