<?php

namespace  Dabilo\MiniWindow\Model;


use Magento\Framework\App\Request\Http;

class News
{
    const REQUEST_TIMEOUT = 2000;

    const END_POINT_URL = 'https://vnexpress.net/rss/kinh-doanh.rss';

    private $response;
    /**
     * @var \Magento\Framework\HTTP\Client\CurlFactory
     */
    private $curlFactory;
    /**
     * @var Http
     */
    private $http;
    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $jsonHelper;

    /**
     * News constructor.
     * @param \Magento\Framework\HTTP\Client\CurlFactory $curlFactory
     * @param Http $http
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\HTTP\Client\CurlFactory $curlFactory,
        Http $http,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    )
    {
        $this->curlFactory = $curlFactory;
        $this->http = $http;
        $this->jsonHelper = $jsonHelper;
    }

    public function getNewsResponse()
    {
        if(!$this->response){
            $this->response = (object) $this->getResponseFromEndPoint();
        }
        return $this->response;
    }

    private function getResponseFromEndPoint()
    {
        return $this->getResponse()->getContents();
    }

    private function getResponse()
    {
        /** @var \Magento\Framework\HTTP\Client\Curl $client */
        $client = $this->curlFactory->create();
        $client->setTimeout(self::REQUEST_TIMEOUT);
        $client->get(
            self::END_POINT_URL 
        );
        return $client->getBody();
    }
}