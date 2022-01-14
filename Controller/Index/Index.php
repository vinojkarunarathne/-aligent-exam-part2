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

namespace Aligent\LiveChat\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Aligent\LiveChat\Controller\Index
 */
class Index extends \Aligent\LiveChat\Controller\Index implements HttpGetActionInterface
{
    /**
     * Show Livechat page
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
