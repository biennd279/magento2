<?php


namespace Dabilo\Payment\Gateway\Zalopay\Response;

use Dabilo\Payment\Gateway\Zalopay\Validator\AbstractResponseValidator;
use Magento\Sales\Model\Order\Payment;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Response\HandlerInterface;


class TransactionRefundHandler implements HandlerInterface
{
    /**
     * @var array
     */
    private $additionalInformationMapping = [
        'transaction_type' => AbstractResponseValidator::TRANSACTION_TYPE,
        'transaction_id' => AbstractResponseValidator::TRANSACTION_ID,
    ];

    /**
     * @param array $handlingSubject
     * @param array $response
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = SubjectReader::readPayment($handlingSubject);
        /** @var Payment $orderPayment */
        $orderPayment = $paymentDO->getPayment();
        $orderPayment->setTransactionId($response[AbstractResponseValidator::REFUND_ID]);

        $orderPayment->setIsTransactionClosed(true);
        $orderPayment->setShouldCloseParentTransaction(!$orderPayment->getCreditmemo()->getInvoice()->canRefund());

        foreach ($this->additionalInformationMapping as $informationKey => $responseKey) {
            if (isset($response[$responseKey])) {
                $orderPayment->setAdditionalInformation($informationKey, ucfirst($response[$responseKey]));
            }
        }
    }
}
