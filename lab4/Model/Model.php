<?php
    interface ModelData {
        public static function row_to_model($row);
        public static function rows_to_model($rows);
    }

    interface ModelDB {
        public function getRows();
        public function getRowById($model_id);
        public function getRowsByColumnValue($columnName, $value);
        public function insertRow($model);
        public function updateRowById($model, $new_model);
        public function deleteRowById($model_id);
    }
?>