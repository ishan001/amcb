<?php
class TeachersPage extends Page {

    private static $has_many = array(
        'Teachers' => 'Teacher'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Teachers', GridField::create(
            'Teachers',
            'Teachers',
            $this->Teachers(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

}