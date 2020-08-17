<?php
namespace Magepow\Autorelated\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $pageFactory;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		return $this->pageFactory->create();
	}
}