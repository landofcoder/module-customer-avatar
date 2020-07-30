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

namespace Lof\CustomerAvatar\Plugin\Metadata\Form;

/**
 * Class Image
 * @package Lof\CustomerAvatar\Plugin\Metadata\Form
 */
class Image
{
    /**
     * @var \Lof\CustomerAvatar\Model\Source\Validation\Image
     */
    protected $validImage;

    /**
     * Image constructor.
     * @param \Lof\CustomerAvatar\Model\Source\Validation\Image $validImage
     */
    public function __construct(
        \Lof\CustomerAvatar\Model\Source\Validation\Image $validImage
    ) {
        $this->validImage = $validImage;
    }

    /**
     * {@inheritdoc}
     *
     * @return ImageContentInterface|array|string|null
     */
    public function beforeExtractValue(\Magento\Customer\Model\Metadata\Form\Image $subject, $value)
    {
        $attrCode = $subject->getAttribute()->getAttributeCode();

        if ($this->validImage->isImageValid('tmp_name', $attrCode) === false) {
            $_FILES[$attrCode]['tmp_name'] = $_FILES[$attrCode]['tmp_name'];
            unset($_FILES[$attrCode]['tmp_name']);
        }

        return [$value];
    }
}
