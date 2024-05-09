<?php
/**
 * Copyright (c) 2024 Ytec.
 *
 * @package    Ytec
 * @moduleName Base
 * @author     Matheus Marqui (matheus.marqui@live.com)
 */
declare(strict_types=1);

namespace Ytec\Base\Api\Rest;

/**
 * This interface is used to send responses to the client,
 * works with Magento webapi defaults.
 *
 * Interface RestResponseInterface
 * @package Ytec\Base\Api\Rest
 */
interface RestResponseInterface
{
    /**
     * Sends a 200 OK response.
     * @param array<mixed>|null $data
     * @return $this
     */
    public function ok(?array $data = null): self;

    /**
     * Sends a 201 Created response.
     * @param array<mixed>|null $data
     * @return $this
     */
    public function created(?array $data = null): self;

    /**
     * Sends a 204 No Content response.
     * @return $this
     */
    public function noContent(): self;

    /**
     * Sends a 400 Bad Request response.
     * @param array<mixed>|null $data
     * @return $this
     */
    public function badRequest(?array $data = null): self;

    /**
     * Sends a 401 Unauthorized response.
     * @param array|null $data
     * @return $this
     */
    public function unauthorized(?array $data = null): self;

    /**
     * Sends a 403 Forbidden response.
     * @param array|null $data
     * @return $this
     */
    public function forbidden(?array $data = null): self;

    /**
     * Sends a 404 Not Found response.
     * @param array|null $data
     * @return $this
     */
    public function notFound(?array $data = null): self;

    /**
     * Sends a 500 Internal Server Error response.
     * @param array|null $data
     * @return $this
     */
    public function internalError(?array $data = null): self;

    /**
     * Sends a response.
     * @param int $code
     * @param array<mixed>|null $data
     * @param array|null $headers
     * @return $this
     */
    public function response(int $code, ?array $data = null, ?array $headers = null): self;
}
