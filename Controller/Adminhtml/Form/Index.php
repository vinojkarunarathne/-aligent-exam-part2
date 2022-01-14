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

namespace Aligent\LiveChat\Controller\Adminhtml\Form;

use Aligent\LiveChat\Model\ConfigInterface as LiveChatConfigInterface;
use Aligent\LiveChat\Model\SendEmailToAdmin;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Aligent\LiveChat\Controller\Adminhtml\Form
 */
class Index extends Action
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
     * @param Action\Context $context
     * @param LiveChatConfigInterface $liveChatConfigInterface
     * @param SendEmailToAdmin $sendEmailToAdmin
     */
    public function __construct(
        Action\Context          $context,
        LiveChatConfigInterface $liveChatConfigInterface,
        SendEmailToAdmin        $sendEmailToAdmin
    ) {
        $this->liveChatConfigInterface = $liveChatConfigInterface;
        $this->sendEmailToAdmin = $sendEmailToAdmin;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $liveChatFormData = $this->getRequest()->getPost('livechat');
        if ($liveChatFormData) {
            // Set Live Chat Form Data to Configurations
            $this->liveChatConfigInterface->setLiveChatFormDataToConfigurations($liveChatFormData);

            // Send Live Chat Email Notification to Admin
            $this->sendEmailToAdmin->sendEmailToAdmin($liveChatFormData);
            $this->messageManager->addSuccessMessage(__('Live Chat Form Has been submitted. Live Chat Configurations has been updated'));
        }
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
