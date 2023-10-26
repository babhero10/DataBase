<?php
    interface Model {
        public function getById($model_id): Model;
        public function getRows();
        public function getRowById($model_id);
        public function updateRow($model);
        public function deleteRow($model_id);
      }
?>