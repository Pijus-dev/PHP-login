<?php

class FileDB
{
    private $file_name;
    private $data;

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * setData sets new array into data array
     *
     * @param  array $data_array
     * @return void
     */
    public function setData(array $data_array)
    {
        $this->data = $data_array;
    }

    /**
     * save function saves data to a file
     *
     * @return void
     */
    public function save()
    {
        array_to_file($this->data, $this->file_name);
    }

    /**
     * load function loads data from the file
     *
     * @return array
     */
    public function load()
    {
        $data_array = file_to_array($this->file_name);
        $this->data = $data_array ? $data_array : [];
    }

    /**
     * getData function gest data from the file
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * createTable function creates table in the file
     *
     * @param  string $table_name
     * @return bool
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * tableExists function checks if the table already exists in the file
     *
     * @param  string $table_name
     * @return bool
     */
    public function tableExists(string $table_name): bool
    {
        return array_key_exists($table_name, $this->data);
    }

    /**
     * dropTable function removes table from the file
     *
     * @param  string $table_name
     * @return bool
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    /**
     * truncateTable deletes all the values from the table
     *
     * @param  string $table_name
     * @return bool
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * insertRow function inserts row into array
     *
     * @param  string $table_name
     * @param  array $row
     * @param  int $row_id
     * @return mixed
     */
    public function insertRow(string $table_name, array $row, int $row_id = null)
    {
        if (!$this->tableExists($table_name) || $this->rowExists($table_name, $row_id)) {
            return false;
        }
        if ($row_id) {
            $this->data[$table_name][$row_id] = $row;
        } else {
            $this->data[$table_name][] = $row;
            $row_id = array_key_last($this->data[$table_name]);
        }

        return $row_id;
    }

    /**
     * rowExists checks if the row exists
     *
     * @param  string $table_name
     * @param   $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): ?bool
    {
        return isset($this->data[$table_name][$row_id]);
    }

    /**
     * insertRowIfNotExists inserts row if it does not exist
     *
     * @param  string $table_name
     * @param array $row
     * @param  int $row_id
     * @return mixed
     */
    public function insertRowIfNotExists(string $table_name, array $row, int $row_id)
    {
        if (!$this->rowExists($table_name, $row_id)) {
            $this->insertRow($table_name, $row, $row_id);
            return $row_id;
        }

        return false;
    }

    /**
     * updateRow updates the current row
     *
     * @param  string $table_name
     * @param  array $row
     * @param  int $row_id
     * @return bool
     */
    public function updateRow(string $table_name, array $row, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;
            return true;
        }

        return false;
    }

    /**
     * deleteRow 
     *
     * @param  string $table_name
     * @param  int $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);
            return true;
        }

        return false;
    }

    /**
     * getRowById gets the row by ID
     *
     * @param  string $table_name
     * @param  int $row_id
     * @return mixed
     */
    public function getRowById(string $table_name, int $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }
    
    /**
     * getRowsWhere puts all the rows into array where every condition is met
     *
     * @param  string $table_name
     * @param  array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions): array
    {
        $rows = [];

        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $conditions_met = true;

            foreach ($conditions as $condition_key => $condition) {
                if ($row[$condition_key] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                $rows[$row_id] = $row;
            }
        }

        return $rows;
    }
    
    /**
     * getRowWhere return the single row if each condition is met
     *
     * @param  string $table_name
     * @param  array $conditions
     * @return mixed
     */
    public function getRowWhere(string $table_name, array $conditions)
    {
        foreach ($this->data[$table_name] ?? [] as $row_id => $row) {
            $conditions_met = true;
            
            foreach ($conditions as $condition_key => $condition) {
                if ($row[$condition_key] !== $condition) {
                    $conditions_met = false;
                    break;
                }
            }

            if ($conditions_met) {
                return $row;
            }
        }

        return false;
    }
}
