<?php

/**
 * array_to_file function saves data to file
 *
 * @param  array $array
 * @param  string $filename
 * @return bool
 */
function array_to_file(array $array, string $filename): bool
{
    $data = json_encode($array);
    $success = file_put_contents($filename, $data);

    if ($success === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * file_to_array gets a data from file and converts to array
 *
 * @param  string $filename
 * @return mixed
 */
function file_to_array(string $filename)
{
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        return json_decode($data, true) ?? [];
    } else {
        return false;
    }
}
