<?php

class EventPage extends Page
{

    private static $has_many = array(
        'Events' => 'Event'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Events', GridField::create(
            'Events',
            'Events',
            $this->Events(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

}