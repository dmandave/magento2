<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Block\Adminhtml\Edit;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Ui\Component\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var AccountManagementInterface
     */
    protected $customerAccountManagement;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagementInterface $customerAccountManagement
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        AccountManagementInterface $customerAccountManagement
    ) {
        parent::__construct($context, $registry);
        $this->customerAccountManagement = $customerAccountManagement;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        $canModify = !$customerId || !$this->customerAccountManagement->isReadonly($this->getCustomerId());
        $data = [];
        if ($canModify) {
            $data = [
                'label' => __('Save Customer'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}