<?php
namespace Magepow\Autorelated\Block\Adminhtml\Grid\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magepow\Autorelated\Model\Status $status,
     * @param \Magepow\Autorelated\Model\Slider $slider,
     * @param \Magepow\Autorelated\Model\Position $position,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magepow\Autorelated\Model\Status $status,
        \Magepow\Autorelated\Model\Yesno $yesno,
        \Magepow\Autorelated\Model\Position $position,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_status = $status;
        $this->_yesno = $yesno;
        $this->_position = $position;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('mage_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Related Product'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Related Product'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry'
            ]
        );

        $fieldset->addField(
            'products',
            'text',
            [
                'name' => 'products',
                'label' => __('Related product ids'),
                'id' => 'products',
                'title' => __('Related product ids'),
                'class' => 'required-entry',
                'required' => true,
                'after_element_html' => 'Enter the product ids separated by commas. Ex: 1,2,3,4,5.',
            ]
        );

        $fieldset->addField(
            'position',
            'select',
            [
                'name' => 'position',
                'label' => __('Product display position'),
                'id' => 'position',
                'title' => __('Product display position'),
                'values' => $this->_position->getOptionArray(),
                'class' => 'position'
            ]
        );

        $fieldset->addField(
            'slider',
            'select',
            [
                'name' => 'slider',
                'label' => __('Active Slider'),
                'id' => 'slider',
                'title' => __('Active Slider'),
                'values' => $this->_yesno->getOptionArray(),
                'class' => 'slider',
                'value' => 1,
            ]
        );        

        $fieldset->addField(
            'cart',
            'select',
            [
                'name' => 'cart',
                'label' => __('Show Cart'),
                'id' => 'cart',
                'title' => __('Show Cart'),
                'values' => $this->_yesno->getOptionArray(),
                'class' => 'cart',
                'value' => 1,
            ]
        );        

        $fieldset->addField(
            'compare',
            'select',
            [
                'name' => 'compare',
                'label' => __('Show Compare'),
                'id' => 'compare',
                'title' => __('Show Compare'),
                'values' => $this->_yesno->getOptionArray(),
                'class' => 'compare',
                'value' => 1,
            ]
        );        

        $fieldset->addField(
            'wishlist',
            'select',
            [
                'name' => 'wishlist',
                'label' => __('Show Wishlist'),
                'id' => 'wishlist',
                'title' => __('Show Wishlist'),
                'values' => $this->_yesno->getOptionArray(),
                'class' => 'wishlist',
                'value' => 1,
            ]
        );

        $fieldset->addField(
            'review',
            'select',
            [
                'name' => 'review',
                'label' => __('Show Review'),
                'id' => 'review',
                'title' => __('Show Review'),
                'options' => $this->_yesno->getOptionArray(),
                'class' => 'review',
                'value' => 1,
            ]
        );

        /* Check is single store mode */
        // if (!$this->_storeManager->isSingleStoreMode()) {
        //     $field = $fieldset->addField(
        //         'stores',
        //         'multiselect',
        //         [
        //             'name' => 'stores[]',
        //             'label' => __('Store View'),
        //             'title' => __('Store View'),
        //             'required' => true,
        //             'values' => $this->_systemStore->getStoreValuesForForm(false, true)
        //         ]
        //     );
        //     $renderer = $this->getLayout()->createBlock(
        //         'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
        //     );
        //     $field->setRenderer($renderer);
        // } else {
        //     $fieldset->addField(
        //         'stores',
        //         'hidden',
        //         ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
        //     );
        //     $model->setStoreId($this->_storeManager->getStore(true)->getId());
        // }

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->_status->getOptionArray(),
                'class' => 'status',
                'value' => 1,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
