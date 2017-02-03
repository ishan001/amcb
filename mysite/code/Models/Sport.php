<?php

class Sport extends DataObject {

    private static $db = array (
        'Title' => 'Varchar'
    );

    private static $belongs_many_many = array (
        'Members' => 'Member',
    );

    public function getCMSFields() {
        return FieldList::create(
            TextField::create('Title')
        );
    }
}