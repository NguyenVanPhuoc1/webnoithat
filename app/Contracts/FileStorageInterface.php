<?php 
namespace App\Contracts;

interface FileStorageInterface
{
    public function upload_file($file, $directory);
    public function remove_file($filePath);
}

?>