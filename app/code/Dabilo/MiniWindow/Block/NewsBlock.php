<?php

namespace Dabilo\MiniWindow\Block;


use Magento\Framework\View\Element\Template;

class NewsBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Dabilo\MiniWindow\Model\NewsFactory
     */
    private $NewsFactory;

    /**
     * NewsBlock constructor.
     * @param Template\Context $context
     * @param \Dabilo\MiniWindow\Model\NewsFactory $NewsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Dabilo\MiniWindow\Model\NewsFactory $NewsFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->NewsFactory = $NewsFactory;
    }

    /**
     * @return \Dabilo\MiniWindow\Model\News[]
     */
    public function getNewsInformation()
    {
        return $this->NewsFactory->create()->getNewsResponse();
    }
}