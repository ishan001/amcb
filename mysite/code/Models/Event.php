<?php

class Event extends DataObject
{
    public static $db = array(
        "Title" => "Text",
        "Date" => "Date",
        "Time" => "Text",
        "Location" => 'varchar',
        'Description' => 'HTMLText',
    );

    public static $has_one = array(
        "Image" => "Image",
        "EventPage" => "EventPage"
    );

    public static $summary_fields = array(
        "Date" => "Date",
        "Title" => "Title"
    );

    public static $default_sort = "Date ASC, Time ASC";

    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('Title', 'Event Title'),
            DateField::create('Date', 'Event Date')
                ->setConfig('showcalendar', true),
            TextField::create('Location', 'Event Location'),
            $imageField = UploadField::create('Image', 'Image'),
            HtmlEditorField::create('Description'),

        ));

        $imageField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $imageField->setConfig('allowedMaxFileNumber', 1);
        $imageField->setFolderName('Events');
        $imageField->setCanPreviewFolder(false);

        return $fields;
    }

}