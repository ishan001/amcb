<?php

class HomePage extends Page
{

    private static $has_one = array(
        'AboutSchoolImage' => 'Image',
    );
    private static $has_many = array(
        'Slider' => 'ImageGalleryItem',
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $Content = $fields->dataFieldByName('Content');
        $Content->Title='About School';
        $AboutImageField = new UploadField('AboutSchoolImage', 'About School Image');
        $AboutImageField->getValidator()->setAllowedExtensions(File::config()->app_categories['image']);
        $AboutImageField->setFolderName("Site");
        $fields->addFieldToTab('Root.Slider', GridField::create(
            'Slider',
            'Slider',
            $this->Slider(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->insertBefore($AboutImageField,'Content');
        $fields->addFieldsToTab('Root.Main', array(
            $AboutImageField
        ));
        return $fields;
    }

}

class HomePage_Controller extends Page_Controller
{
    public function init()
    {
        parent::init();

    }

}