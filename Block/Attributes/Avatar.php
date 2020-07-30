<?php

/**
 * Lof
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Lof.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Lof
 * @package     Lof_CustomerAvatar
 * @copyright   Copyright (c) 2019 Lof (https://landofcoder.com/)
 * @license     https://landofcoder.com/LICENSE.txt
 */

namespace Lof\CustomerAvatar\Block\Attributes;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class Avatar
 * @package Lof\CustomerAvatar\Block\Attributes
 */
class Avatar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\View\Element\AbstractBlock
     */
    protected $viewFileUrl;

    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customer;

    /**
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param \Magento\Framework\View\Asset\Repository $viewFileUrl
     * @param \Magento\Customer\Model\Customer $customer
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        \Magento\Customer\Model\Customer $customer
    ) {
        $this->objectManager = $objectManager;
        $this->viewFileUrl = $viewFileUrl;
        $this->customer = $customer;
        parent::__construct($context);
    }

    /**
     * Check the file is already exist in the path.
     * @return boolean
     */
    public function checkImageFile($file)
    {
        $file = base64_decode($file);
        $filesystem = $this->objectManager->get(\Magento\Framework\Filesystem::class);
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $fileName = CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER . '/' . ltrim($file, '/');
        $path = $directory->getAbsolutePath($fileName);
        if (!$directory->isFile($fileName)
            && !$this->objectManager->get(\Magento\MediaStorage\Helper\File\Storage::class)->processStorageFile($path)
        ) {
            return false;
        }
        return true;
    }

    /**
     * Get the avatar of the customer is already logged in
     * @return string
     */
    public function getAvatarCurrentCustomer($file)
    {
        if ($this->checkImageFile(base64_encode($file)) === true) {
            return $this->getUrl('viewfile/avatar/view/', ['image' => base64_encode($file)]);
        }
        return $this->viewFileUrl->getUrl('Lof_CustomerAvatar::images/no-profile-photo.jpg');
    }

    /**
     * Get the avatar of the customer by the customer id
     * @return string
     */
    public function getCustomerAvatarById($customer_id = false)
    {
        if ($customer_id) {
            $customerDetail = $this->customer->load($customer_id);
            if ($customerDetail && !empty($customerDetail->getProfilePicture())) {
                if ($this->checkImageFile(base64_encode($customerDetail->getProfilePicture())) === true) {
                    return $this->getUrl(
                        'viewfile/avatar/view/',
                        ['image' => base64_encode($customerDetail->getProfilePicture())]
                    );
                }
            }
        }
        return $this->viewFileUrl->getUrl('Lof_CustomerAvatar::images/no-profile-photo.jpg');
    }
}
