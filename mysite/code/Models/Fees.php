<?php

class Fees extends DataObject
{

    private static $db = array(
        'FeesYear' => 'Int',
        'SchoolFees' => 'Int',
        'SecurityFees' => 'Int',
        'FacilityFees' => 'Int',
        'MaintenanceFees' => 'Int',
        'ExtraExpenses' => 'Int'
    );

    private static $has_one = array(
        'FeesType' => 'FeesType'
    );

    public static $summary_fields = array(
        "FeesYear" => "FeesYear",
        "FeesType.Title" => "Fees Type",
        "SchoolFees" => "SchoolFees",
        "SecurityFees" => "SecurityFees",
        "FacilityFees" => "FacilityFees",
        "MaintenanceFees" => "MaintenanceFees",
        "ExtraExpenses" => "ExtraExpenses",

    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main", "FeesTypeID");

        $fields->addFieldsToTab('Root.Main', array(
            DropdownField::create(
                'FeesType',
                'Fees Type',
                FeesType::get()->map('ID', 'Title')
            )->setEmptyString('-- Select Fees Type --'),
            DropdownField::create('FeesYear')
                ->setSource(ArrayLib::valuekey(range((date('Y') - 2), date('Y') + 5))),
            TextField::create('SchoolFees', 'School Fees'),
            TextField::create('SecurityFees', 'Security Fees'),
            TextField::create('FacilityFees', 'Facility Fees'),
            TextField::create('MaintenanceFees', 'Maintenance Fees'),
            TextField::create('ExtraExpenses', 'Extra Expenses'),
        ));

        return $fields;
    }

    function getCMSValidator()
    {
        return new RequiredFields('FeesType', 'SchoolFees', 'FeesYear');
    }
}