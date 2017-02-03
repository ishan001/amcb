<?php

class Grade extends DataObject {

    private static $db = array (
        'Title' => 'Varchar'
    );

    public function getCMSFields() {
        return FieldList::create(
            TextField::create('Title')
        );
    }
}