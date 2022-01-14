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

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class SendEmailToAdmin
 * @package Aligent\LiveChat\Model
 */
class SendEmailToAdmin
{
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var ConfigInterface
     */
    protected $configInterface;

    /**
     * SendEmailToAdmin constructor.
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     * @param ConfigInterface $configInterface
     */
    public function __construct(
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        ConfigInterface $configInterface
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->configInterface = $configInterface;
    }

    /**
     * send email notification to admin
     *
     * @param $liveChatFormData
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function sendEmailToAdmin($liveChatFormData)
    {
        $senderName = $this->configInterface->getSenderName();
        $senderEmail = $this->configInterface->getSenderEmail();
        $emailTemplate = $this->configInterface->getEmailTemplate();
        $recipientEmail = $this->configInterface->getRecipientEmail();
        if ($senderName && $senderEmail && $emailTemplate && $recipientEmail) {
            $this->sendEmail(
                $recipientEmail,
                $liveChatFormData,
                $senderName,
                $senderEmail,
                $emailTemplate
            );
        }
    }

    /**
     * Send email
     *
     * @param $recipientEmail
     * @param $templatesVars
     * @param $senderName
     * @param $senderEmail
     * @param $emailTemplate
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function sendEmail($recipientEmail, $templatesVars, $senderName, $senderEmail, $emailTemplate)
    {
        $this->inlineTranslation->suspend();
        $sender = [
            'name' => $senderName,
            'email' => $senderEmail,
        ];

        $transport = $this->transportBuilder
            ->setTemplateIdentifier($emailTemplate)
            ->setTemplateOptions(
                [
                    'area' => Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId(),
                ]
            )
            ->setTemplateVars($templatesVars)
            ->setFrom($sender)
            ->addTo($recipientEmail)
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
    }
}
