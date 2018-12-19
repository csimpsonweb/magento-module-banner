<?php

namespace Maximuspoder\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Maximuspoder\Banner\Model\Banner;
use Maximuspoder\Banner\Model\ResourceModel\Banner as BannerResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(Banner::class, BannerResource::class);
    }
}
