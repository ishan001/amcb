<?php

class StudentMemberExtension extends DataExtension {

    private static $db = array (
        'JoinDate' => 'Date',
        'Contact' => 'Varchar',
        'AdmissionID' => 'Int',
        'Description' => 'HTMLText',
        'ParentEmail' => 'Varchar',
    );

    private static $has_one = array (
        'Photo' => 'Image',
        'Grade' => 'Grade'
    );

    private static $many_many = array (
        'Sports' => 'Sport',
        'Subjects' => 'Subject',
        'CurriculumActivities' => 'CurriculumActivity'
    );

    public function updateCMSFields(FieldList $fields) {

        $fields->addFieldToTab('Root.Sports', CheckboxSetField::create(
            'Sports',
            'Selected sports',
            Sport::get()->map('ID', 'Title')
        ));

        $fields->addFieldToTab('Root.Subjects', CheckboxSetField::create(
            'Subjects',
            'Selected subjects',
            Subject::get()->map('ID', 'Title')
        ));

        $fields->addFieldToTab('Root.Curriculum Activities', CheckboxSetField::create(
            'CurriculumActivities',
            'Selected Curriculum Activities',
            CurriculumActivity::get()->map('ID', 'Title')
        ));

    }


}