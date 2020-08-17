<?php
namespace Magepow\Autorelated\Controller\Adminhtml\Related;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Magepow\Autorelated\Model\RelatedFactory
     */
    private $relatedFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Magepow\Autorelated\Model\RelatedFactory $relatedFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magepow\Autorelated\Model\RelatedFactory $relatedFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->relatedFactory = $relatedFactory;
    }

    /**
     * Mapped Related List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->relatedFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getRelatedId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('related/related/rowdata');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Related Product ').$rowTitle : __('Add Related Product');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magepow_Autorelated::add_row');
    }
}
