<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\Forms\GridField\GridFieldConfig as SS_GridFieldConfig;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldPageCount;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldDetailForm;

/**
 * Allows editing of records contained within the GridField, instead of only allowing the ability to view records in
 * the GridField.
 *
 */
class GridFieldConfig extends SS_GridFieldConfig {

	/**
     * Get a list of subclasses for the chosen type (either CatalogueProduct
     * or CatalogueCategory).
     *
	 * @param string $classname
     *
     * @return array
     */
    protected function getCreatableClasses(string $classname): array
    {
        // Get a list of available product classes
        $classnames = ClassInfo::subclassesFor($classname);
        $return = [];

        foreach ($classnames as $classname) {
            $instance = singleton($classname);
            $return[$classname] = $instance->i18n_singular_name();
        }

        asort($return);
        return $return;
    }

	public function __construct(string $classname)
    {
		parent::__construct();

		// Setup initial gridfield
		$this->addComponent(new GridFieldButtonRow('before'));
		$this->addComponent(new GridFieldToolbarHeader());
		$this->addComponent($sort = new GridFieldSortableHeader());
		$this->addComponent($filter = new GridFieldFilterHeader());
		$this->addComponent(new GridFieldDataColumns());
		$this->addComponent(new GridFieldEditButton());
		$this->addComponent(new GridFieldDeleteAction());
		$this->addComponent(new GridFieldPageCount('toolbar-header-right'));
		$this->addComponent($pagination = new GridFieldPaginator());
		$this->addComponent(new GridFieldExportButton("buttons-before-right"));
		$this->addComponent(new GridFieldDetailForm());

		// Setup add new button
		$add_button = new GridFieldAddNewMultiClass("buttons-before-left");
        $add_button->setClasses($this->getCreatableClasses($classname));
		$this->addComponent($add_button);

		$sort->setThrowExceptionOnBadDataType(false);
		$filter->setThrowExceptionOnBadDataType(false);
		$pagination->setThrowExceptionOnBadDataType(false);
	}
}