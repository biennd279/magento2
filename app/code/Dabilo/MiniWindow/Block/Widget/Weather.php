<?php

declare(strict_types=1);

namespace Dabilo\MiniWindow\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Weather extends Template implements BlockInterface
{

    protected $_template = "widget/weather.phtml";

    /**
     * @var WeatherFactory
     */
    private WeatherFactory $weatherFactory;

    /**
     * WeatherBlock constructor.
     * @param Template\Context $context
     * @param WeatherFactory $weatherFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        WeatherFactory $weatherFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->weatherFactory = $weatherFactory;
    }

    /**
     * @return object
     */
    public function getWeatherInformation(): object
    {
        return $this->weatherFactory->create()->getWeatherResponse();
    }
}
