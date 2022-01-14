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

namespace Aligent\LiveChat\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface LiveChatLogInterface
 * @package Aligent\LiveChat\Api\Data
 */
interface LiveChatLogInterface extends ExtensibleDataInterface
{
    const LIVECHAT_LOG_ID           = 'livechat_log_id';
    const LIVECHAT_LICENSE_NUMBER   = 'livechat_license_number';
    const LIVECHAT_GROUPS           = 'livechat_groups';
    const LIVECHAT_PARAMS           = 'livechat_params';
    const ROUTER                    = 'router';

    /**
     * Get livechat_log_id
     * @return string|null
     */
    public function getLiveChatLogId();

    /**
     * Set livechat_log_id
     * @param string $liveChatLogId
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatLogId($liveChatLogId);

    /**
     * Get livechat_license_number
     * @return string|null
     */
    public function getLiveChatLicenseNumber();

    /**
     * Set livechat_license_number
     * @param string $liveChatLicenseNumber
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatLicenseNumber($liveChatLicenseNumber);

    /**
     * Get livechat_groups
     * @return string|null
     */
    public function getLiveChatGroups();

    /**
     * Set livechat_groups
     * @param string $liveChatGroups
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatGroups($liveChatGroups);

    /**
     * Get livechat_params
     * @return string|null
     */
    public function getLiveChatParams();

    /**
     * Set livechat_params
     * @param string $liveChatParams
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setLiveChatParams($liveChatParams);

    /**
     * Get router
     * @return string|null
     */
    public function getRouter();

    /**
     * Set router
     * @param string $router
     * @return \Aligent\LiveChat\Api\Data\LivechatLogInterface
     */
    public function setRouter($router);
}
