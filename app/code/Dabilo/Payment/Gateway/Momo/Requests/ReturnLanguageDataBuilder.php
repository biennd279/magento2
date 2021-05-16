<?php


namespace Dabilo\Payment\Gateway\Momo\Requests;


class ReturnLanguageDataBuilder extends AbstractDataBuilder implements \Magento\Payment\Gateway\Request\BuilderInterface
{

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::LANG => "vi", //Fix vietnamese
        ];
    }
}
