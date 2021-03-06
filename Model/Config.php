<?php
/**
 * Copyright © 2022 Aligent Consulting. All rights reserved.
 * https://www.aligent.com.au/
 */

/**
 * @category Aligent
 * @package  Aligent_LiveChat
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 *
 * @author   Anton Vinoj<antonvinoj@gmail.com>
 */

namespace Aligent\LiveChat\Model;

use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Aligent LiveChat module configuration
 *
 * Class Config
 * @package Aligent\LiveChat\Model
 */
class Config implements ConfigInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @var TypeListInterface
     */
    private $cacheTypeList;

    /**
     * @var Pool
     */
    private $cacheFrontendPool;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param WriterInterface $configWriter
     * @param TypeListInterface $cacheTypeList
     * @param Pool $cacheFrontendPool
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
    }

    /**
     * @return bool|mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_GENERAL_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get license config value
     *
     * @return mixed
     */
    public function getLiveChatLicense()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_GENERAL_LICENCE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get advanced group config value
     *
     * @return mixed
     */
    public function getLiveChatAdvancedGroup()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ADVANCED_GROUP,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get advanced params config value
     *
     * @return mixed
     */
    public function getLiveChatAdvancedParams()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ADVANCED_PARAMS,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get sender name config value
     *
     * @return mixed
     */
    public function getSenderName()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_SENDER_NAME,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get sender email config value
     *
     * @return mixed
     */
    public function getSenderEmail()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_SENDER_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get recipient email config value
     *
     * @return mixed
     */
    public function getRecipientEmail()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_RECIPIENT_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get email template config value
     *
     * @return mixed
     */
    public function getEmailTemplate()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Set license config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatLicense($value)
    {
        $this->setConfigData(self::XML_PATH_GENERAL_LICENCE, $value);
    }

    /**
     * Set advanced group config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatAdvancedGroup($value)
    {
        $this->setConfigData(self::XML_PATH_ADVANCED_GROUP, $value);
    }

    /**
     * Set advanced params config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatAdvancedParams($value)
    {
        $this->setConfigData(self::XML_PATH_ADVANCED_PARAMS, $value);
    }

    /**
     * @param $path
     * @param $value
     */
    public function setConfigData($path, $value)
    {
        $this->configWriter->save($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
    }

    /**
     * @return mixed|void
     */
    public function cacheCleanByTags()
    {
        $types = ['block_html','config', 'full_page'];

        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }

        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }

    /**
     * Set Live Chat Form Data to Configurations
     *
     * @param $liveChatFormData
     * @return mixed|void
     */
    public function setLiveChatFormDataToConfigurations($liveChatFormData)
    {
        $liveChatLicenseNumber = isset($liveChatFormData['livechat-license-number']) ? $liveChatFormData['livechat-license-number'] : '';
        $liveChatGroups = isset($liveChatFormData['livechat-groups']) ? $liveChatFormData['livechat-groups'] : '';
        $liveChatParams = isset($liveChatFormData['livechat-params']) ? $liveChatFormData['livechat-params'] : '';

        // set Livechat License Number
        if ($liveChatLicenseNumber) {
            $this->setLiveChatLicense($liveChatLicenseNumber);
        }

        // set Livechat Groups
        if ($liveChatGroups) {
            $this->setLiveChatAdvancedGroup($liveChatGroups);
        }

        // set Livechat License Number
        if ($liveChatParams) {
            $this->setLiveChatAdvancedParams($liveChatParams);
        }

        // clear configuration cache
        $this->cacheCleanByTags();
    }
}
