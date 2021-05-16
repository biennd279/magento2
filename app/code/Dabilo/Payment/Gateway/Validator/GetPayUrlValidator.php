<?php


namespace Dabilo\Payment\Gateway\Validator;


use Dabilo\Payment\Gateway\Requests\AbstractDataBuilder;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Validator\ResultInterface;

class GetPayUrlValidator extends AbstractResponseValidator
{
    /**
     * @param array $validationSubject
     * @return ResultInterface
     */
    public function validate(array $validationSubject): ResultInterface
    {
        $response = SubjectReader::readResponse($validationSubject);
        $payment = SubjectReader::readPayment($validationSubject);
        $orderId = $payment->getOrder()->getOrderIncrementId();
        $errorMessages = [];
        $validationResult = $this->validateErrorCode($response)
            && $this->validateOrderId($response, $orderId)
            && $this->validateSignature($response);

        if (!$validationResult) {
            $errorMessages = [__('Something went wrong when get pay url.')];
        }

        return $this->createResult($validationResult, $errorMessages);
    }

    /**
     * @return array
     */
    protected function getSignatureArray() : array
    {
        return [
            AbstractDataBuilder::REQUEST_ID,
            AbstractDataBuilder::ORDER_ID,
            self::RESPONSE_MESSAGE,
            self::RESPONSE_LOCAL_MESSAGE,
            self::PAY_URL,
            self::ERROR_CODE,
            AbstractDataBuilder::REQUEST_TYPE
        ];
    }

    /**
     * Validate Order Id
     *
     * @param array   $response
     * @param $orderId
     * @return boolean
     */
    protected function validateOrderId(array $response, $orderId): bool
    {
        return isset($response[AbstractDataBuilder::ORDER_ID])
            && (string)($response[AbstractDataBuilder::ORDER_ID]) === (string)$orderId;
    }
}
