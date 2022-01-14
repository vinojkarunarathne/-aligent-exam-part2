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

/**
 * Aligent LiveChat module configuration
 *
 * Interface ConfigInterface
 * @package Aligent\LiveChat\Model
 */
interface ConfigInterface
{
    /**
     * Enabled config path
     */
    const XML_PATH_GENERAL_ENABLED          = 'livechat/general/enabled';

    /**
     * license config path
     */
    const XML_PATH_GENERAL_LICENCE          = 'livechat/general/license';

    /**
     * advanced group config path
     */
    const XML_PATH_ADVANCED_GROUP           = 'livechat/advanced/group';

    /**
     * advanced params config path
     */
    const XML_PATH_ADVANCED_PARAMS          = 'livechat/advanced/params';

    /**
     * sender name config path
     */
    const XML_PATH_EMAIL_SENDER_NAME        = 'livechat/email/sender_name';

    /**
     * sender email config path
     */
    const XML_PATH_EMAIL_SENDER_EMAIL       = 'livechat/email/sender_email';

    /**
     * recipient email config path
     */
    const XML_PATH_EMAIL_RECIPIENT_EMAIL    = 'livechat/email/recipient_email';

    /**
     * email template config path
     */
    const XML_PATH_EMAIL_TEMPLATE           = 'livechat/email/email_template';

    /**
     * Check if Aligent LiveChat module is enabled
     *
     * @return mixed
     */
    public function isEnabled();

    /**
     * Get license config value
     *
     * @return mixed
     */
    public function getLiveChatLicense();

    /**
     * Get advanced group config value
     *
     * @return mixed
     */
    public function getLiveChatAdvancedGroup();

    /**
     * Get advanced params config value
     *
     * @return mixed
     */
    public function getLiveChatAdvancedParams();

    /**
     * Get sender name config value
     *
     * @return mixed
     */
    public function getSenderName();

    /**
     * Get sender email config value
     *
     * @return mixed
     */
    public function getSenderEmail();

    /**
     * Get recipient email config value
     *
     * @return mixed
     */
    public function getRecipientEmail();

    /**
     * Get email template config value
     *
     * @return mixed
     */
    public function getEmailTemplate();

    /**
     * Set license config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatLicense($value);

    /**
     * Set advanced group config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatAdvancedGroup($value);

    /**
     * Set advanced params config value
     *
     * @param $value
     * @return mixed
     */
    public function setLiveChatAdvancedParams($value);

    /**
     * @return mixed
     */
    public function cacheCleanByTags();

    /**
     * Set Live Chat Form Data to Configurations
     *
     * @param $liveChatFormData
     * @return mixed
     */
    public function setLiveChatFormDataToConfigurations($liveChatFormData);
}
