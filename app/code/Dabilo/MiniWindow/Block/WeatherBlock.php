<?php

namespace Dabilo\MiniWindow\Block;


use Magento\Framework\View\Element\Template;

class WeatherBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Dabilo\MiniWindow\Model\WeatherFactory
     */
    private $weatherFactory;

    /**
     * WeatherBlock constructor.
     * @param Template\Context $context
     * @param \Dabilo\MiniWindow\Model\WeatherFactory $weatherFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Dabilo\MiniWindow\Model\WeatherFactory $weatherFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->weatherFactory = $weatherFactory;
    }

    /**
     * @return \Dabilo\MiniWindow\Model\Weather[]
     */
    public function getWeatherInformation()
    {
        return $this->weatherFactory->create()->getWeatherResponse();
    }
}