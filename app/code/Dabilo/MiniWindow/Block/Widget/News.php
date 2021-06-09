<?php

declare(strict_types=1);

namespace Dabilo\MiniWindow\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class News extends Template implements BlockInterface
{

    protected $_template = "widget/news.phtml";
    /**
     * @var NewsFactory
     */
    private NewsFactory $NewsFactory;

    /**
     * NewsBlock constructor.
     * @param Template\Context $context
     * @param NewsFactory $NewsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NewsFactory $NewsFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->NewsFactory = $NewsFactory;
    }

    /**
     * @return object
     */
    public function getNewsInformation(): object
    {
        return $this->NewsFactory->create()->getNewsResponse();
    }
}
