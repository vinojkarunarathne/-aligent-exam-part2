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

namespace Aligent\LiveChat\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class LiveChatForm
 * @package Aligent\LiveChat\Block
 */
class LiveChatForm extends Template
{
    /**
     * LiveChatForm constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Returns action url for livechat form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('livechat/index/post', ['_secure' => true]);
    }
}
