<?php

namespace Maximuspoder\Banner\Ui\Edit;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    /** @var $collection */
    protected $collection;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param $collection
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        $collection,
        array $meta = [],
        array $data = []
    ){
        $this->collection = $collection;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData))
            return $this->_loadedData;

        $items = $this->collection->getItems();
        if(empty($items))
            return $this->_loadedData;

        foreach ($items as $item) {
            $this->_loadedData[$item->getId()]['banner_edit_form'] = $item->getData();
        }

        return $this->_loadedData;
    }
}

