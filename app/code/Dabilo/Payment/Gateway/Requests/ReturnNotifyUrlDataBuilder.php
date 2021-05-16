<?php


namespace Dabilo\Payment\Gateway\Requests;


use Magento\Framework\UrlInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class ReturnNotifyUrlDataBuilder extends AbstractDataBuilder implements BuilderInterface
{
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * ReturnNotifyUrlDataBuilder constructor.
     *
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @inheritdoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::RETURN_URL => $this->urlBuilder->getUrl('momo/payment/return'),
            self::NOTIFY_URL => $this->urlBuilder->getUrl('momo/payment/ipn')
        ];
    }
}
