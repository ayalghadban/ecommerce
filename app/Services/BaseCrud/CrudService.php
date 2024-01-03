<?php


namespace App\Services\BaseCrud;

use Illuminate\Database\Eloquent\Model;

abstract class  CrudService{
    private Model $Model;

    public function __construct(Model $model)
    {
        $this->Model = $model;
    }

    public function create(array $data)
    {
        return  $this->Model::create($data);
    }

    public function edit($id, $data)
    {
        $objectToEdit =  $this->Model::findOrFail($id);
        $objectToEdit->update($data);

        return $objectToEdit;
    }

    public function delete($id)
    {
        $objectToDelete = $this->Model::findOrFail($id);
        $objectToDelete->delete();

        return true;
    }

    public function getAll()
    {
        return  $this->Model::get();
    }

    public function getAllWithPaginate($Resource,  $per_page = 8, $search = null)
    {
        $data = new $this->Model;

        if (isset($search)) {

            $search_keyword = $search->key;
            $search_value = $search->value;

            $data->where($search_keyword, 'LIKE', '%' . $search_value . '%');
        }

        $data = new $Resource($data->paginate($per_page));

        return $data;
    }

    public function update_status($id, $new_status)
    {

        $object = $this->Model::where('id', $id)->first();
      
        $object->is_active = $new_status == false ? 0 : 1;

       
        $object->save();

        return true;
    }

    public function getOne($id, $relation = null)
    {
        $object = $this->Model->with($relation)->where('id', $id)->first();
        return $object;
    }
}
