<?php 

namespace App\Contracts;

interface CrudOperationsInterface{

    //base function

    public function create(array $data);  // Trả về mảng data sau khi xử lý
    public function add(array $data);  
    public function getAll();
    public function getById($id);
    //update function
    public function update(array $data, $id);

    //delete
    public function delete($id);

}
?>