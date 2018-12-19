<?php

namespace Maximuspoder\Banner\Model;

use Maximuspoder\Banner\Model\Data\BannerRepositoryInterface;


class BannerRepository implements BannerRepositoryInterface
{

    const BANNER_ACTIVE = 1;
    /** @var BannerFactory $bannerResourceModel */
    protected $bannerModelFactory;

    /**
     * BannerRepository constructor.
     * @param \Maximuspoder\Banner\Model\BannerFactory $bannerModelFactory
     */
    public function __construct(
        \Maximuspoder\Banner\Model\BannerFactory $bannerModelFactory
    )
    {
        $this->setBannerModelFactory($bannerModelFactory);
    }

    /**
     * @param int $id
     * @return \Magento\Framework\DataObject|mixed
     */
    public function getById(int $id)
    {
        $banner = $this->getBannerModelFactory()->create()
            ->getCollection()
            ->addFieldToFilter('id', $id)
            ->getFirstItem();

        return $banner;
    }

    /**
     * @return \Magento\Framework\DataObject|mixed
     */
    public function getByActive()
    {
        $banner = $this->getBannerModelFactory()->create()
            ->getCollection()
            ->addFieldToFilter('status', self::BANNER_ACTIVE)
            ->getItems();

        return $banner;
    }

    /**
     * @return \Maximuspoder\Banner\Model\BannerFactory
     */
    public function getBannerModelFactory(): BannerFactory
    {
        return $this->bannerModelFactory;
    }

    /**
     * @param \Maximuspoder\Banner\Model\BannerFactory $bannerModelFactory
     */
    public function setBannerModelFactory(BannerFactory $bannerModelFactory)
    {
        $this->bannerModelFactory = $bannerModelFactory;
    }

}