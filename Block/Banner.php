<?php

namespace Maximuspoder\Banner\Block;

use Magento\Framework\View\Element\Template;
use Maximuspoder\Banner\Model\BannerRepository;

class Banner extends \Magento\Framework\View\Element\Template
{
    /** @var \Maximuspoder\Banner\Model\BannerRepository $bannerRepository */
    protected $bannerRepository;

    /**
     * Banner constructor.
     * @param Template\Context $context
     * @param array $data
     * @param BannerRepository $bannerRepository
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        BannerRepository $bannerRepository
    )
    {
        $this->setBannerRepository($bannerRepository);
        parent::__construct($context, $data);
    }

    public function getBannerImages()
    {
        return $this->getBannerRepository()->getByActive();
    }

    /**
     * @return BannerRepository
     */
    public function getBannerRepository(): BannerRepository
    {
        return $this->bannerRepository;
    }

    /**
     * @param BannerRepository $bannerRepository
     */
    public function setBannerRepository(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }



}