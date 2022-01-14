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

namespace Aligent\LiveChat\Controller;

use Aligent\LiveChat\Model\ConfigInterface as LiveChatConfigInterface;
use Aligent\LiveChat\Model\SendEmailToAdmin;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NotFoundException;

/**
 * Class Index
 * @package Aligent\LiveChat\Controller
 */
abstract class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var LiveChatConfigInterface
     */
    protected $liveChatConfigInterface;

    /**
     * @var SendEmailToAdmin
     */
    protected $sendEmailToAdmin;

    /**
     * Index constructor.
     * @param Context $context
     * @param LiveChatConfigInterface $liveChatConfigInterface
     * @param SendEmailToAdmin $sendEmailToAdmin
     */
    public function __construct(
        Context $context,
        LiveChatConfigInterface $liveChatConfigInterface,
        SendEmailToAdmin $sendEmailToAdmin
    ) {
        parent::__construct($context);
        $this->liveChatConfigInterface = $liveChatConfigInterface;
        $this->sendEmailToAdmin = $sendEmailToAdmin;
    }

    /**
     * Dispatch request
     *
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->liveChatConfigInterface->isEnabled()) {
            throw new NotFoundException(__('Page not found.'));
        }
        return parent::dispatch($request);
    }
}
