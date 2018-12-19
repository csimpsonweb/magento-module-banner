<?php

namespace Maximuspoder\Banner\Model;

use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel
{
    protected $_eventPrefix = 'maximuspoder_banners';

    protected function _construct()
    {
        $this->_init(\Maximuspoder\Banner\Model\ResourceModel\Banner::class);
    }
}