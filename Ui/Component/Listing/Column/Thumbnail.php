<?php

namespace Maximuspoder\Banner\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Thumbnail extends Column
{
    /** @var \Magento\Store\Model\StoreManagerInterface $storeManager */
    protected $storeManager;

    /** @var \Magento\Framework\UrlInterface $urlInterface */
    protected $urlInterface;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        StoreManagerInterface $storeManager,
        UrlInterface $urlInterface
    )
    {
        $this->setStoreManager($storeManager);
        $this->setUrlInterface($urlInterface);
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach($dataSource['data']['items'] as & $item) {
                $url = '';
                if($item[$fieldName] != '') {
                    $url = $this->getStoreManager()
                            ->getStore()
                            ->getBaseUrl().'pub/'. \Magento\Framework\UrlInterface::URL_TYPE_MEDIA .'/'. $item[$fieldName];
                }
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                $item[$fieldName . '_link'] = $this->getUrlInterface()->getUrl(
                    'Maximuposder/Banner/edit',
                    ['id' => $item['id']]
                );
                $item[$fieldName . '_orig_src'] = $url;
            }
        }

        return $dataSource;
    }

    protected function getAlt($row)
    {
        $altField = 'name';
        return isset($row[$altField]) ? $row[$altField] : null;
    }

    /**
     * @return UrlInterface
     */
    public function getUrlInterface(): UrlInterface
    {
        return $this->urlInterface;
    }

    /**
     * @param UrlInterface $urlInterface
     */
    public function setUrlInterface(UrlInterface $urlInterface)
    {
        $this->urlInterface = $urlInterface;
    }

    /**
     * @return StoreManagerInterface
     */
    public function getStoreManager(): StoreManagerInterface
    {
        return $this->storeManager;
    }

    /**
     * @param StoreManagerInterface $storeManager
     */
    public function setStoreManager(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }


}