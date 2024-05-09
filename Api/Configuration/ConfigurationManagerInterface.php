<?php
/**
 * Copyright (c) 2024 Ytec.
 *
 * @package    Ytec
 * @moduleName Base
 * @author     Matheus Marqui (matheus.marqui@live.com)
 */
declare(strict_types=1);

namespace Ytec\Base\Api\Configuration;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Api\Data\WebsiteInterface;

/**
 * Interface ConfigurationManagerInterface
 * @package Ytec\Base\Api\Configuration
 * @api
 */
interface ConfigurationManagerInterface
{
    /**
     * Get configuration value by key.
     *
     * @param string $key
     * @param int|null $storeId
     * @return string
     * @throws NoSuchEntityException If store is not found.
     */
    public function get(string $key, int $storeId = null): string;

    /**
     * Check if configuration is on by key.
     *
     * @param string $key
     * @param int|null $storeId
     * @return bool
     * @throws NoSuchEntityException If store is not found.
     */
    public function isOn(string $key, int $storeId = null): bool;

    /**
     * Check if configuration is off by key.
     *
     * @param string $key
     * @param int|null $storeId
     * @return bool
     * @throws NoSuchEntityException If store is not found.
     */
    public function isOff(string $key, int $storeId = null): bool;

    /**
     * Get a store.
     *
     * @param int|null $storeId If null, will return current store.
     * @return StoreInterface
     * @throws NoSuchEntityException If store is not found.
     */
    public function getStore(int $storeId = null): StoreInterface;

    /**
     * Get current website.
     *
     * @param int|null $websiteId If null, will return current website.
     * @return WebsiteInterface
     * @throws NoSuchEntityException If website is not found.
     * @throws LocalizedException If an error occurs.
     */
    public function getWebsite(int $websiteId = null): WebsiteInterface;
}
