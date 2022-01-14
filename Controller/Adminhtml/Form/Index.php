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
use Aligent\LiveChat\Model\LiveChatLog as LiveChatLogModel;
use Aligent\LiveChat\Model\SendEmailToAdmin;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Aligent\LiveChat\Controller\Adminhtml\Form
 */
class Index extends Action
{
    const ROUTER_TYPE  = 'Admin';

    /**
     * @var LiveChatConfigInterface
     */
    protected $liveChatConfigInterface;

    /**
     * @var SendEmailToAdmin
     */
    protected $sendEmailToAdmin;

    /**
     * @var LiveChatLogModel
     */
    protected $liveChatLogModel;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param LiveChatConfigInterface $liveChatConfigInterface
     * @param SendEmailToAdmin $sendEmailToAdmin
     * @param LiveChatLogModel $liveChatLogModel
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context          $context,
        LiveChatConfigInterface $liveChatConfigInterface,
        SendEmailToAdmin        $sendEmailToAdmin,
        LiveChatLogModel        $liveChatLogModel,
        PageFactory             $resultPageFactory
    ) {
        $this->liveChatConfigInterface = $liveChatConfigInterface;
        $this->sendEmailToAdmin = $sendEmailToAdmin;
        $this->liveChatLogModel = $liveChatLogModel;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $liveChatFormData = $this->getRequest()->getPost('livechat');
            if ($liveChatFormData) {
                // Set Live Chat Form Data to Configurations
                $this->liveChatConfigInterface->setLiveChatFormDataToConfigurations($liveChatFormData);

                // Send Live Chat Email Notification to Admin
                $this->sendEmailToAdmin->sendEmailToAdmin($liveChatFormData);

                // Save Live Chat Form Data to aligent_livechat_log table
                $this->liveChatLogModel->saveLiveChatLogs($liveChatFormData, self::ROUTER_TYPE);

                $this->messageManager->addSuccessMessage(__('Live Chat Form Has been submitted. Live Chat Configurations has been updated'));
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $resultPage = $this->resultPageFactory->create();
        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu('Aligent_LiveChat::admin_form');
        $resultPage->getConfig()->getTitle()->prepend(__('Live Chat'));
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
