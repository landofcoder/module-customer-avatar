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

namespace Lof\CustomerAvatar\Plugin\CustomerData;

use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;
use Lof\CustomerAvatar\Block\Attributes\Avatar;

/**
 * Class Customer
 * @package Lof\CustomerAvatar\Plugin\CustomerData
 */
class Customer
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var View
     */
    protected $customerViewHelper;

    /**
     * @var Avatar
     */
    protected $customerAvatar;

    /**
     * @param CurrentCustomer $currentCustomer
     * @param View $customerViewHelper
     * @param Avatar $customerAvatar
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        View $customerViewHelper,
        Avatar $customerAvatar
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->customerViewHelper = $customerViewHelper;
        $this->customerAvatar = $customerAvatar;
    }

    /**
     * {@inheritdoc}
     */
    public function afterGetSectionData()
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return [];
        }
        $customer = $this->currentCustomer->getCustomer();
        if (!empty($customer->getCustomAttribute('profile_picture'))) {
            $file = $customer->getCustomAttribute('profile_picture')->getValue();
        } else {
            $file = '';
        }
        return [
            'fullname' => $this->customerViewHelper->getCustomerName($customer),
            'firstname' => $customer->getFirstname(),
            'avatar' => $this->customerAvatar->getAvatarCurrentCustomer($file)
        ];
    }
}
