<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Ryan
     * Date: 2/20/12
     * Time: 7:11 PM
     * To change this template use File | Settings | File Templates.
     */

    // DataTable -> a copy off of the DataTable class from .Net. Thus far, it implements only the most commonly used features.
    // Feel free to extend it if you like it.
    class DataTable
    {
        private $Rows;
        private $Columns;
        private $TableName = "";


        public function __construct($TableName = "") {
            $this->TableName = $TableName;

        }

       public function Columns() {
           return $this->Columns();
       }

        public function Rows() {
            return $this->Rows();

        }

        // I've collapsed two functions into one, to more closely mimic .Net's take on things. Though a perversion of good programming etiquite, I need to make allowances for the insanity
        // of the language I am programming in.
        public function TableName($TableName = null) {
            if($TableName == null) {
                return $this->TableName;
            }
            else {
                $this->TableName = $TableName;
            }

        }

        public function Clear() {
            $this->TableName = "";
            $this->Rows = Array();
            $this->Columns = Array();
        }

        public function Copy() {
            $newTable = new DataTable($this->GetTableName());
            foreach($this->Columns as $Column) {

            }
            foreach($this->Rows as $Row) {

            }
        }

        public function NewRow() {
            return new DataRow($this);
        }

        public function ToString() {

        }




    }

    class DataRow {

        private $ObjectArray = Array();
        private $DataTable;


        public function __construct($DataTable = null) {
            $this->DataTable = $DataTable;
        }

        public function ItemArray($ObjectArray) {
            $this->ObjectArray = $ObjectArray;
        }

        public function SetField($Column, $Value) {
                $this->ObjectArray[Column] = $Value;
        }

        public function GetField($Column) {
            return $this->ObjectArray[Column];
        }

        public function Table() {
            return $this->DataTable;
        }

    }

    class DataRowCollection {
        private $Rows = Array();

        public function __construct() {

        }

        public function Count() {
            return count($this->Rows);

        }

        public function Clear() {
            $this->Rows = Array();
        }

        public function Find() {

        }

        public function Remove($DataRow) {

        }

        public function RemoveAt($Index) {
            unset($this->Rows[$Index]);
        }

        public function ToString() {

        }

        public function InsertAt($Index) {

        }

        public function Contains($DataRow) {
            return in_array($DataRow, $this->Rows);
        }

        public function IndexOf($DataRow) {
            for ($i=0; $i < count($this->Rows); $i++) {
                if ($this->Rows[$i] == $DataRow) {
                    return $i;
                }
            }
            return false;

        }


    }

    class DataColumn {
        private $ColumnName = "";
        private $DataType = "";
        private $Maxlength = -1;
        private $DefaultValue = "";

        const MAXLENGTH = -1;

        public function __construct($ColumnName, $Type = null) {
            $this->ColumnName = $ColumnName;
            $this->Type = $Type;
        }

        public function DataType($Type = null) {
            if($Type == null) {
                return $this->DataType;
            }
            else {
                $this->DataType = $Type;
            }
        }

        public function MaxLength($Length = null) {
            if($Length == null) {
                return $this->Maxlength;
            }
            else {
                $this->MaxLength = $Length;
            }
        }

        public function DefaultValue($Value = null) {
            if($Value == null) {
                return $this->DefaultValue;
            }
            else {
                $this->DefaultValue = $Value;
            }
        }

    }

    class DataColumnCollection {
        private $Columns = Array();


        public function __construct() {

        }

        public function Count() {
            return count($this->Columns);
        }

        public function Add($Column) {
            $this->Columns[] = $Column;
        }

        public function Clear() {
            $this->Columns = Array();
        }

        public function Contains($Column) {
            return in_array($Column, $this->Columns);
        }

        public function IndexOf($Column) {
            for ($i=0; $i < count($this->Columns); $i++) {
                if ($this->Columns[$i] == $Column) {
                    return $i;
                }
            }
            return false;

        }

        public function Remove($Column) {
            //@todo: Keep an eye on this function. Since we are removing the object from the array, not from an index, there may be many references to the object contained therein.
            // Will need a while loop here.
        }

        public function RemoveAt($Index) {
            unset($this->Columns[$Index]);
        }

        public function ToString() {

        }

    }


?>