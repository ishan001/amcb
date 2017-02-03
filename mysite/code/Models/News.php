<?php

class News extends DataObject
{
    public static $db = array(
        "Title" => "Text",
        "Date" => "Date",
        'Description' => 'HTMLText',
    );

    public static $has_one = array(
        "Image" => "Image",
        "NewsPage" => "NewsPage",
        "Album" => "ImageGalleryAlbum"
    );

    public static $summary_fields = array(
        "Date" => "Date",
        "Title" => "Title"
    );

    public static $default_sort = "Date DESC";

    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('Title', 'News Title'),
            DateField::create('Date', 'News Date')
                ->setConfig('showcalendar', true),
            DropdownField::create(
                'AlbumID',
                'Album',
                ImageGalleryAlbum::get()->map('ID', 'AlbumName')
            )->setEmptyString('-- Select Album --'),
            $imageField = UploadField::create('Image', 'Image'),
            HtmlEditorField::create('Description')

        ));

        $imageField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $imageField->setConfig('allowedMaxFileNumber', 1);
        $imageField->setFolderName('News');
        $imageField->setCanPreviewFolder(false);

        return $fields;
    }

}