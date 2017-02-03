<?php

class FeesType extends DataObject
{

    private static $db = array(
        'Title' => 'Varchar'
    );
    private static $summary_fields = array(
        'Title' => 'Title'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', array(
            TextField::create('Title', 'Fees Type')
        ));

        return $fields;
    }

}