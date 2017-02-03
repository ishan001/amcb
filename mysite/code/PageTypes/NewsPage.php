<?php
class NewsPage extends Page {

    private static $has_many = array(
        'News' => 'News'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.News', GridField::create(
            'News',
            'News',
            $this->News(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

}