<?php


namespace Dabilo\Payment\Gateway\Command;


use Dabilo\Payment\Gateway\Helper\TransactionReader;
use Dabilo\Payment\Gateway\Validator\AbstractResponseValidator;
use Magento\Payment\Gateway\CommandInterface;
use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Model\MethodInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Payment;

class UpdateOrderCommand implements CommandInterface
{
    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * Constructor
     *
     * @param ConfigInterface          $config
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        ConfigInterface $config,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->config          = $config;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param array $commandSubject
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(array $commandSubject)
    {
        $paymentDO = SubjectReader::readPayment($commandSubject);

        /** @var Payment $payment */
        $payment = $paymentDO->getPayment();
        $order   = $payment->getOrder();
        ContextHelper::assertOrderPayment($payment);

        if ($order->getState() === Order::STATE_PENDING_PAYMENT) {
            switch ($this->config->getValue('payment_action')) {
                case MethodInterface::ACTION_AUTHORIZE_CAPTURE:
                    $payment->capture();
                    break;
            }
        }

        if (TransactionReader::isIpn($commandSubject)) {
            $message = __('IPN "%1"', SubjectReader::readResponse($commandSubject)[AbstractResponseValidator::RESPONSE_MESSAGE]);
            $payment->prependMessage($message);
            $order->addCommentToStatusHistory($message);
        }

        $this->orderRepository->save($order);
    }
}
