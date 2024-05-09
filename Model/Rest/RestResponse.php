<?php
/**
 * Copyright (c) 2024 Ytec.
 *
 * @package    Ytec
 * @moduleName Base
 * @author     Matheus Marqui (matheus.marqui@photoweb.fr)
 */
declare(strict_types=1);

namespace Ytec\Base\Model\Rest;

use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Magento\Framework\Webapi\Rest\Response as WebapiRestResponse;
use Ytec\Base\Api\Rest\RestResponseInterface;
use Laminas\Http\Response as HttpResponseCode;

/**
 * Class RestResponse
 * @package Ytec\Base\Model\Rest
 */
class RestResponse implements RestResponseInterface
{
    /**
     * @var JsonSerializer
     */
    private JsonSerializer $jsonSerializer;

    /**
     * @var WebapiRestResponse
     */
    private WebapiRestResponse $webapiRestResponse;

    /**
     * Default headers
     * @var array<string>
     */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json'
    ];

    /**
     * RestResponse constructor.
     * @param JsonSerializer $jsonSerializer
     * @param WebapiRestResponse $webapiRestResponse
     */
    public function __construct(JsonSerializer $jsonSerializer, WebapiRestResponse $webapiRestResponse)
    {
        $this->jsonSerializer = $jsonSerializer;
        $this->webapiRestResponse = $webapiRestResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function ok(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_200, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function created(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_201, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function noContent(): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_204);
    }

    /**
     * {@inheritdoc}
     */
    public function badRequest(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_400, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function unauthorized(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_401, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function forbidden(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_403, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function notFound(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_404, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function internalError(?array $data = null): RestResponseInterface
    {
        return $this->response(HttpResponseCode::STATUS_CODE_500, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function response(int $code, ?array $data = null, ?array $headers = null): RestResponseInterface
    {
        $this->setHeaders($this->webapiRestResponse, $headers ?? $this->defaultHeaders);
        $this->webapiRestResponse->setHttpResponseCode($code);

        if ($data) {
            $this->webapiRestResponse->setBody($this->jsonSerializer->serialize($data));
        }

        $this->webapiRestResponse->sendResponse();

        return $this;
    }

    /**
     * Set headers.
     * @param WebapiRestResponse $webapiRestResponse
     * @param array<string> $headers
     */
    private function setHeaders(WebapiRestResponse $webapiRestResponse, array $headers): void
    {
        foreach ($headers as $header => $value) {
            $webapiRestResponse->setHeader($header, $value, true);
        }
    }
}
