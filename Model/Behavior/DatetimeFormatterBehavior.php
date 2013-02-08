<?php
class DatetimeFormatterBehavior extends ModelBehavior {

    private $__defaultSettings = array(
        'date_format' => '%d/%m/%Y',
        'date_suffix' => '_d',
        'datetime_suffix' => '_dt',
        'datetime_format' => '%d/%m/%Y %H:%i:%s',
        'fields' => true,
    );

    public function setup(Model $Model, $config = array()) {
        $this->settings[$Model->alias] = $config + $this->__defaultSettings;
        $this->addDefaultVirtualFields($Model);
    }

    public function addDefaultVirtualFields($Model) {
        extract($this->settings[$Model->alias], EXTR_SKIP);
        $colTypes = $Model->getColumnTypes();
        foreach($colTypes as $field => $type){
            if($fields === true || in_array($field, $fields)){
                if($type === 'date' || $type === 'datetime'){
                    $Model->virtualFields[$field . $date_suffix] = "date_format($Model->alias.$field, '" . $date_format . "')";
                    $Model->virtualFields[$field . $datetime_suffix] = "date_format($Model->alias.$field, '" . $datetime_format . "')";
                }
            }
        }
    }

}