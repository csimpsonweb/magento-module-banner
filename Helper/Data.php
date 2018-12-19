<?php

namespace Maximuspoder\Banner\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const BANNER_PATH = 'maximuspoder/banner/';

    const ALLOWED_EXTENSIONS = [
        'jpg','jpeg','gif','png'
    ];
    /** @var \Magento\Framework\App\Filesystem\DirectoryList $directoryList */
    protected $directoryList;

    /** @var \Magento\Framework\Filesystem $filesystem */
    protected $filesystem;

    /** @var \Magento\Framework\App\Helper\Context $context */
    protected $context;

    /** @var \Magento\MediaStorage\Model\File\UploaderFactory $uploadFactory */
    protected $uploadFactory;

    public function __construct(
        Context $context,
        DirectoryList $directoryList,
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory
    )
    {
        $this->setContext($context);
        $this->setDirectoryList($directoryList);
        $this->setFilesystem($filesystem);
        $this->setUploadFactory($uploaderFactory);
        parent::__construct($context);
    }

    /**
     * @param string $fieldId
     * @return null|string
     * @throws \Exception
     */
    public function uploadImage($fieldId = 'image')
    {
        $_FILES = $this->getContext()->getRequest()->getFiles('general');

        if (isset($_FILES[$fieldId]) && $_FILES[$fieldId]['name'] !='')
        {
            $uploadFactory = $this->getUploadFactory()->create(['fileId' => $fieldId]);
            $mediaDirectory = $this->getFilesystem()->getDirectoryRead(DirectoryList::MEDIA);

            try {
                $uploadFactory->setAllowedExtensions(self::ALLOWED_EXTENSIONS);
                $uploadFactory->setAllowRenameFiles(true);
                $uploadFactory->setFilesDispersion(false);
                $newFileName = $this->regenerateFileName($uploadFactory->getFileExtension());

                $result = $uploadFactory->save($mediaDirectory->getAbsolutePath(self::BANNER_PATH), $newFileName);

                return self::BANNER_PATH . $newFileName;
            } catch (\Exception $e) {
                $this->_logger->critical($e);
                throw new \Exception($e->getMessage());
            }
        }
        return null;
    }

    /**
     * Generate when upload file
     * @return string
     */
    public function regenerateFileName($extension)
    {
        return md5(date('Y-m-d H:i:s') . rand(0,1000)) . '.' . $extension;
    }

    /**
     * @return UploaderFactory
     */
    public function getUploadFactory(): UploaderFactory
    {
        return $this->uploadFactory;
    }

    /**
     * @param UploaderFactory $uploadFactory
     */
    public function setUploadFactory(UploaderFactory $uploadFactory)
    {
        $this->uploadFactory = $uploadFactory;
    }

    /**
     * @return Context
     */
    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getDirectoryList()
    {
        return $this->directoryList;
    }

    /**
     * @param mixed $directoryList
     */
    public function setDirectoryList($directoryList)
    {
        $this->directoryList = $directoryList;
    }

    /**
     * @return mixed
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param mixed $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }


}