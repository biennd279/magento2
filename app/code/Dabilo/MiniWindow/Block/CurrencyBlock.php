<?php

namespace Dabilo\MiniWindow\Block;


use Magento\Framework\View\Element\Template;

class CurrencyBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Dabilo\MiniWindow\Model\CurrencyFactory
     */
    private $CurrencyFactory;

    /**
     * CurrencyBlock constructor.
     * @param Template\Context $context
     * @param \Dabilo\MiniWindow\Model\CurrencyFactory $CurrencyFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Dabilo\MiniWindow\Model\CurrencyFactory $CurrencyFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->CurrencyFactory = $CurrencyFactory;
    }

    /**
     * @return \Dabilo\MiniWindow\Model\Currency[]
     */
    public function getCurrencyInformation()
    {
        return $this->CurrencyFactory->create()->getCurrencyResponse();
    }
}