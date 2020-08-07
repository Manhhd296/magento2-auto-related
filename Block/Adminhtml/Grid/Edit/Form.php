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
     * @param \Magepow\Autorelated\Model\Status $options,
     * @param \Magepow\Autorelated\Model\Position $position,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magepow\Autorelated\Model\Status $options,
        \Magepow\Autorelated\Model\Position $position,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_options = $options;
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

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
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
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'products',
            'text',
            [
                'name' => 'products',
                'label' => __('Products'),
                'id' => 'products',
                'title' => __('Products'),
                'class' => 'required-entry',
                'required' => true,
                'comments' => 'Enter the product ids separated by commas',
            ]
        );

        $fieldset->addField(
            'position',
            'select',
            [
                'name' => 'position',
                'label' => __('Position'),
                'id' => 'position',
                'title' => __('Position'),
                'values' => $this->_position->getOptionArray(),
                'class' => 'position',
                'required' => true,
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
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
