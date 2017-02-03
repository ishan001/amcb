<?php

class Teacher extends DataObject
{
    public static $db = array(
        "TeacherName" => "Text",
        "JoinedDate" => "Date",
        "Contact" => "Varchar",
        "Email" => "Varchar",
        'About' => 'HTMLText',
        'Qualifications' => 'HTMLText',

    );

    public static $has_one = array(
        "Image" => "Image",
        "TeachersPage" => "TeachersPage",
        'ClassTeacher' => 'Grade'
    );

    public static $many_many = array(
        "Subjects" => "Subject",
        'Grades' => 'Grade',
    );

    public static $summary_fields = array(
        "TeacherName" => "TeacherName"
    );

    public static $default_sort = "JoinedDate ASC";

    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('TeacherName', 'Teacher Name'),
            DateField::create('JoinedDate', 'Joined Date')
                ->setConfig('showcalendar', true),
            TextField::create('Contact', 'Contact Numbers'),
            TextField::create('Email', 'Email Address'),
            TagField::create(
                'Subjects',
                'Subjects',
                Subject::get(),
                $this->Subjects()
            )->setShouldLazyLoad(true)
                ->setDescription('Type First Character(s) and select from dropdown'),
            TagField::create(
                'Grades',
                'Grades',
                Grade::get(),
                $this->Grades()
            )->setShouldLazyLoad(true)
                ->setDescription('Type First Character(s) and select from dropdown'),
            $imageField = UploadField::create('Image', 'Profile Image'),
            HtmlEditorField::create('About'),
            HtmlEditorField::create('Qualifications'),

        ));

        $imageField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $imageField->setConfig('allowedMaxFileNumber', 1);
        $imageField->setFolderName('Teachers');
        $imageField->setCanPreviewFolder(false);

        return $fields;
    }

}