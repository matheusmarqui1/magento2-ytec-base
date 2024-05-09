<?php
/**
 * Copyright (c) 2024 Ytec.
 *
 * @package    Ytec
 * @moduleName Base
 * @author     Matheus Marqui (matheus.marqui@live.com)
 */
declare(strict_types=1);

namespace Ytec\Base\Model\Configuration;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Api\Data\WebsiteInterface;
use Magento\Store\Model\StoreManagerInterface;
use Ytec\Base\Api\Configuration\ConfigurationManagerInterface;

/**
 * Class ConfigurationManager
 * @package Ytec\Base\Model\Configuration
 * Configuration manager.
 */
class ConfigurationManager implements ConfigurationManagerInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, int $storeId = null): string
    {
        return (string)
        $this->scopeConfig->getValue(
            $key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId ?? $this->getStore()->getId()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isOn(string $key, int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            $key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId ?? $this->getStore()->getId()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isOff(string $key, int $storeId = null): bool
    {
        return !$this->isOn($key, $storeId);
    }

    /**
     * {@inheritdoc}
     * @throws NoSuchEntityException
     */
    public function getStore(int $storeId = null): StoreInterface
    {
        return $this->storeManager->getStore($storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getWebsite(int $websiteId = null): WebsiteInterface
    {
        return $this->storeManager->getWebsite($websiteId);
    }
}
