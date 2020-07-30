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

require([
        'jquery',
        'jquery/ui',
        'jquery/validate',
        'mage/translate'
    ], function ($) {
    //Validate Image FileSize
        $('.avatar.validate-image').on('change', function () {
            $('.profile-image, .avatar-file-upload').css({'opacity':'0.5'});
        });
        $.validator.addMethod(
            'validate-image',
            function (v, elm) {
                if (elm.value != '') {
                    var ext = elm.value.split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        return false;
                    }
                }
                return true;
            },
            $.mage.__('Image invalid (Accepting format .gif .png .jpg .jpeg)')
        );
    });
