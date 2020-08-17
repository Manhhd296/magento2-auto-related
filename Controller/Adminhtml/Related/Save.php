<?php
namespace Magepow\Autorelated\Controller\Adminhtml\Related;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magepow\Autorelated\Model\RelatedFactory
     */
    var $relatedFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magepow\Autorelated\Model\RelatedFactory $relatedFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magepow\Autorelated\Model\RelatedFactory $relatedFactory
    ) {
        parent::__construct($context);
        $this->relatedFactory = $relatedFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('related/related/addrow');
            return;
        }
        try {
            $rowData = $this->relatedFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setRelatedId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('related/related/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magepow_Autorelated::save');
    }
}
