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

namespace Aligent\LiveChat\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LiveChatLog
 * @package Aligent\LiveChat\Model\ResourceModel
 */
class LiveChatLog extends AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('aligent_livechat_log', 'livechat_log_id');
    }
}
