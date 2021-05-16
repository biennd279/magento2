<?php
/**
 * Copyright © Bien, Nguyen Dinh All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Dabilo\Payment\Model\Payment;

class Zalopay extends \Magento\Payment\Model\Method\AbstractMethod
{

    protected $_code = "zalopay";
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
        return parent::isAvailable($quote);
    }
}

