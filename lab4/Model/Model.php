<?php
    interface ModelData {
        public static function row_to_model($row);
        public static function rows_to_model($rows);
    }

    interface ModelDB {
        public function getById($model_id);
        public function getRows();
        public function getRowById($model_id);
        public function updateRow($model);
        public function deleteRow($model_id);
      }
?>