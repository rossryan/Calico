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

    //@todo: Ensure the class throws Exceptions when it does somethint stupid.
    //@todo: Synchronize variable names to keep things consistent.
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

        //@todo: Finish Copy mechanism later on.
        /*
        public function Copy() {
            $newTable = new DataTable($this->GetTableName());
            foreach($this->Columns as $Column) {

            }
            foreach($this->Rows as $Row) {

            }
        }
        */


        public function NewRow() {
            return new DataRow($this);
        }

        public function ToString() {
            $s = "";
            $s .= $this->Columns->ToString();
            $s .= $this->Rows->ToString();

            return $s;

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

        public function ToString() {
            $s = "";
            for($i = 0; $i < count($this->ObjectArray); $i++) {
                $s .= $this->ObjectArray[$i]->ToString();
            }

            return $s;

        }

    }

    class DataRowCollection {
        private $Rows = Array();
        private $Table;

        public function __construct($Table) {
            $this->Table = $Table;
        }

        //@todo: Overload this function later to accept an array of DataRows.
        public function Add($DataRow) {
            $this->Rows[] = $DataRow;
        }

        public function Count() {
            return count($this->Rows);
        }

        public function Clear() {
            $this->Rows = Array();
        }

        public function Find($Key) {
            for($i = 0; $i < $this->Rows; $i++) {
                for($j = 0; $j < $this->Table->Columns()->Count(); $j++) {
                    if($Key == $this->Rows[$i]->GetField($j)) {
                        return $this->Rows[$i];
                    }
                }
            }

            return null;

        }

        public function Remove($DataRow) {

            $i = 0;
            while($i < $this->Rows->Count()) {
                if($this->Rows[$i] == $DataRow) {
                    unset($this->Rows[$i]);
                }
                else {
                    $i++;
                }
            }


        }

        public function RemoveAt($Index) {
            unset($this->Rows[$Index]);
        }

        public function ToString() {
            $s = "";
            for($i = 0; $i < $this->Rows->Count(); $i++) {
                $s .= $this->Rows[$i]->ToString();
            }

            return $s;

        }

        public function InsertAt($Index, $DataRow) {
            array_splice($this->Rows, $Index, 0, $DataRow);
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

        public function ToString() {
            return $this->ColumnName;
        }

    }

    class DataColumnCollection {
        private $Columns = Array();
        private $Table;

        public function __construct($Table) {
            $this->Table = $Table;
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
            $i = 0;
            while($i < $this->Columns->Count()) {
                if($this->Columns[$i] == $Column) {
                    unset($this->Columns[$i]);
                }
                else {
                    $i++;
                }
            }
        }

        public function RemoveAt($Index) {
            unset($this->Columns[$Index]);
        }

        public function ToString() {
            $s = "";
            for($i = 0; $i < $this->Columns->Count(); $i++) {
                $s .= $this->Columns[$i]->ToString();
            }

            return $s;

        }

    }


?>