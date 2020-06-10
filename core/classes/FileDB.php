<?php

class FileDB
{
    private $file_name;
    private $data;

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    public function setData(array $data_array)
    {
        $this->data = $data_array;
    }

    public function save()
    {
        array_to_file($this->data, $this->file_name);
    }

    public function load()
    {
        $data_array = file_to_array($this->file_name);
        $this->data = $data_array ? $data_array : [];
    }

    public function getData()
    {
        return $this->data;
    }

    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    public function tableExists(string $table_name): bool
    {
        return array_key_exists($table_name, $this->data);
    }

    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    public function truncateTable(string $table_name)
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

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

    public function rowExists(string $table_name, int $row_id)
    {
        return isset($this->data[$table_name][$row_id]);
    }

    public function insertRowIfNotExists(string $table_name, array $row, int $row_id)
    {
        if (!$this->rowExists($table_name, $row_id)) {
            $this->insertRow($table_name, $row, $row_id);
            return $row_id;
        }

        return false;
    }

    public function updateRow(string $table_name, array $row, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;
            return true;
        }

        return false;
    }

    public function deleteRow(string $table_name, int $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);
            return true;
        }

        return false;
    }

    public function getRowById(string $table_name, int $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }
}
