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

use Aligent\LiveChat\Api\Data\LiveChatLogInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class LiveChatLog
 * @package Aligent\LiveChat\Model
 */
class LiveChatLog extends AbstractModel implements LiveChatLogInterface
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Aligent\LiveChat\Model\ResourceModel\LiveChatLog::class);
    }

    /**
     * Get livechat_log_id
     * @return string|null
     */
    public function getLiveChatLogId()
    {
        return $this->_getData(self::LIVECHAT_LOG_ID);
    }

    /**
     * Set livechat_log_id
     * @param string $liveChatLogId
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatLogId($liveChatLogId)
    {
        return $this->setData(self::LIVECHAT_LOG_ID, $liveChatLogId);
    }

    /**
     * Get livechat_license_number
     * @return string|null
     */
    public function getLiveChatLicenseNumber()
    {
        return $this->_getData(self::LIVECHAT_LICENSE_NUMBER);
    }

    /**
     * Set livechat_license_number
     * @param string $liveChatLicenseNumber
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatLicenseNumber($liveChatLicenseNumber)
    {
        return $this->setData(self::LIVECHAT_LICENSE_NUMBER, $liveChatLicenseNumber);
    }

    /**
     * Get livechat_groups
     * @return string|null
     */
    public function getLiveChatGroups()
    {
        return $this->_getData(self::LIVECHAT_GROUPS);
    }

    /**
     * Set livechat_groups
     * @param string $liveChatGroups
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatGroups($liveChatGroups)
    {
        return $this->setData(self::LIVECHAT_GROUPS, $liveChatGroups);
    }

    /**
     * Get livechat_params
     * @return string|null
     */
    public function getLiveChatParams()
    {
        return $this->_getData(self::LIVECHAT_PARAMS);
    }

    /**
     * Set livechat_params
     * @param string $liveChatParams
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatParams($liveChatParams)
    {
        return $this->setData(self::LIVECHAT_PARAMS, $liveChatParams);
    }

    /**
     * Get router
     * @return string|null
     */
    public function getRouter()
    {
        return $this->_getData(self::ROUTER);
    }

    /**
     * Set router
     * @param string $router
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setRouter($router)
    {
        return $this->setData(self::ROUTER, $router);
    }

    /**
     * save data to aligent_livechat_log table
     *
     * @param $liveChatFormData
     * @param $router
     * @throws \Exception
     */
    public function saveLiveChatLogs(
        $liveChatFormData,
        $router
    ) {
        $liveChatLogsCollection = $this;
        $liveChatLicenseNumber = isset($liveChatFormData['livechat-license-number']) ? $liveChatFormData['livechat-license-number'] : '';
        $liveChatGroups = isset($liveChatFormData['livechat-groups']) ? $liveChatFormData['livechat-groups'] : '';
        $liveChatParams = isset($liveChatFormData['livechat-params']) ? $liveChatFormData['livechat-params'] : '';
        if ($liveChatLicenseNumber) {
            $liveChatLogsCollection->setLiveChatLicenseNumber($liveChatLicenseNumber);
        }
        if ($liveChatGroups) {
            $liveChatLogsCollection->setLiveChatGroups($liveChatGroups);
        }
        if ($liveChatParams) {
            $liveChatLogsCollection->setLiveChatParams($liveChatParams);
        }
        $liveChatLogsCollection->setRouter($router);
        $liveChatLogsCollection->save();
        $liveChatLogsCollection->unsetData();
    }
}
