<?php

class SiteConfigExtension extends DataExtension {

    private static $has_many = array (
        'Sports' => 'Sport',
        'Subjects' => 'Subject',
        'CurriculumActivities' => 'CurriculumActivity',
        'Grade' => 'Grade',
    );

    public function updateCMSFields(FieldList $fields) {

        $fields->addFieldToTab('Root.Sports', GridField::create(
            'Sports',
            'Sports',
            Sport::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.Subjects', GridField::create(
            'Subjects',
            'Subjects',
            Subject::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.Curriculum Activities', GridField::create(
            'CurriculumActivities',
            'Curriculum Activities',
            CurriculumActivity::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.Curriculum Activities', GridField::create(
            'CurriculumActivities',
            'Curriculum Activities',
            CurriculumActivity::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.Grades', GridField::create(
            'Grades',
            'Grades',
            Grade::get(),
            GridFieldConfig_RecordEditor::create()
        ));
    }


}