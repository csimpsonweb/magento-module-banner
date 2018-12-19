<?php

namespace Maximuspoder\Banner\Controller\Adminhtml\Index;

use Maximuspoder\Banner\Helper\Data;
use Maximuspoder\Banner\Model\BannerFactory;

class Save extends \Magento\Backend\App\Action
{
    /** @var \Maximuspoder\Banner\Helper\Data $helper */
    protected $helper;

    /** @var \Maximuspoder\Banner\Model\BannerFactory $bannerFactory */
    protected $bannerFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Data $helper,
        BannerFactory $bannerFactory
    ) {
        $this->setHelper($helper);
        $this->setBannerFactory($bannerFactory);
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $uploadedImage = $this->getHelper()->uploadImage();
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        $this->getBannerFactory()->create()
            ->setData('content', $this->getRequest()->getParam('general')['content'])
            ->setData('image', $uploadedImage)
            ->setData('status', $this->getRequest()->getParam('general')['status'])
            ->save();

        return $this->resultRedirectFactory
                ->create()
                ->setPath('banners/index/index');
    }

    /**
     * @return mixed
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     * @param mixed $helper
     */
    public function setHelper($helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return BannerFactory
     */
    public function getBannerFactory(): BannerFactory
    {
        return $this->bannerFactory;
    }

    /**
     * @param BannerFactory $bannerFactory
     */
    public function setBannerFactory(BannerFactory $bannerFactory)
    {
        $this->bannerFactory = $bannerFactory;
    }
}
