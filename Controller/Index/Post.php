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

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Post
 * @package Aligent\LiveChat\Controller\Index
 */
class Post extends \Aligent\LiveChat\Controller\Index implements HttpPostActionInterface
{
    /**
     * Post user question
     *
     * @return Redirect
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            // Validate Live Chat Form & Get Form Data
            $liveChatFormdata = $this->validatedParams();

            // Set Live Chat Form Data to Configurations
            $this->setLiveChatFormDataToConfigurations($liveChatFormdata);

            $this->messageManager->addSuccessMessage(
                __('Live Chat Form Has been submitted. Live Chat Configurations has been updated')
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
        }
        return $this->resultRedirectFactory->create()->setPath('livechat');
    }

    /**
     * Validate Live Chat Form & Get Form Data
     *
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('livechat-license-number')) === '') {
            throw new LocalizedException(__('Please Enter the Livechat License Number and try again.'));
        }
        if (trim($request->getParam('livechat-groups')) === '') {
            throw new LocalizedException(__('Please Enter the Livechat Groups and try again.'));
        }
        if (trim($request->getParam('livechat-params')) === '') {
            throw new LocalizedException(__('Please Enter the Livechat Params and try again.'));
        }

        return $request->getParams();
    }

    /**
     * Set Live Chat Form Data to Configurations
     *
     * @param $liveChatFormdata
     */
    private function setLiveChatFormDataToConfigurations($liveChatFormdata)
    {
        $livechatLicenseNumber = isset($liveChatFormdata['livechat-license-number']) ? $liveChatFormdata['livechat-license-number'] : '';
        $livechatGroups = isset($liveChatFormdata['livechat-groups']) ? $liveChatFormdata['livechat-groups'] : '';
        $livechatParams = isset($liveChatFormdata['livechat-params']) ? $liveChatFormdata['livechat-params'] : '';

        // set Livechat License Number
        $this->liveChatConfigInterface->setLiveChatLicense($livechatLicenseNumber);

        // set Livechat Groups
        $this->liveChatConfigInterface->setLiveChatAdvancedGroup($livechatGroups);

        // set Livechat License Number
        $this->liveChatConfigInterface->setLiveChatAdvancedParams($livechatParams);

        // clear configuration cache
        $this->liveChatConfigInterface->cacheCleanByTags();
    }
}
