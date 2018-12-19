<?php

namespace Maximuspoder\Banner\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Maximuspoder\Banner\Model\BannerRepository;

class Edit extends \Magento\Backend\App\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $_page;

    /** @var \Magento\Framework\Controller\ResultFactory */
    protected $_result;

    /** @var \Magento\Framework\Message\ManagerInterface */
    protected $_messageManager;

    /** @var \Maximuspoder\Banner\Model\BannerRepository $bannerRepository */
    protected $bannerRepository;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param ManagerInterface $messageManager
     * @param ResultFactory $resultFactory
     * @param PageFactory $pageFactory
     * @param BannerRepository $bannerRepository
     */
    public function __construct(
        Action\Context $context,
        ManagerInterface $messageManager,
        ResultFactory $resultFactory,
        PageFactory $pageFactory,
        BannerRepository $bannerRepository
    )
    {
        $this->setMessageManager($messageManager);
        $this->setResult($resultFactory);
        $this->setPage($pageFactory);
        $this->setBannerRepository($bannerRepository);
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParam('banner_edit_form');
        $page = $this->getPage()->create();

        if(empty($params)){
            $page->getConfig()->getTitle()->prepend((__('Banners')));
            return $page;
        }

        $banner = $this->getBannerRepository()->getById($params['id']);
        $banner->setData('status', $params['status'])
            ->setData('content', $params['content'])
            ->save();

        return $this->_redirect('banners/index/index');
   }

    /**
     * @return PageFactory
     */
    public function getPage(): PageFactory
    {
        return $this->_page;
    }

    /**
     * @param PageFactory $page
     */
    public function setPage(PageFactory $page)
    {
        $this->_page = $page;
    }

    /**
     * @return ResultFactory
     */
    public function getResult(): ResultFactory
    {
        return $this->_result;
    }

    /**
     * @param ResultFactory $result
     */
    public function setResult(ResultFactory $result)
    {
        $this->_result = $result;
    }

    /**
     * @return ManagerInterface
     */
    public function getMessageManager(): ManagerInterface
    {
        return $this->_messageManager;
    }

    /**
     * @param ManagerInterface $messageManager
     */
    public function setMessageManager(ManagerInterface $messageManager)
    {
        $this->_messageManager = $messageManager;
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