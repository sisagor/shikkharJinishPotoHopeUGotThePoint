<?php

namespace App\Repositories;

use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class EloquentRepository
{

    public function all()
    {
        return $this->model->mine()->get();
    }

    public function trashOnly()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function pluck($pluck, $id = null)
    {   if ($id) {
            return $this->model->where('id', $id)->pluck($pluck);
        }
        return $this->model->pluck($pluck);
    }

    //find with select. condition take array key => value, and select also take array.
    public function findSelect($condition, $select = '*')
    {
        return $this->model->where($condition)->select($select)->get();
    }

    public function findTrash($id)
    {
        return $this->model->onlyTrashed()->findOrFail($id);
    }

    public function findBy($filed, $value)
    {
        return $this->model->where($filed, $value)->first();
    }

    public function recent($limit)
    {
        return $this->model->take($limit)->get();
    }

    public function store(Request $request)
    {
        return $this->model->create($request->all());
    }

    public function update(Request $request, $model)
    {
        //$model = $this->model->findOrFail($model);
        $model->update($request->all());
        return $model;
    }

    /*Move to trash*/
    public function trash($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /*Restore*/
    public function restore($id)
    {
        return $this->model->onlyTrashed()->findOrFail($id)->restore();
    }

    /*destroy trash */
    public function destroyTrash($id)
    {
        return $this->model->onlyTrashed()->findOrFail($id)->forceDelete();
    }

    public function destroy($model)
    {
        return $this->model->forceDelete();
    }

    /*mass trash*/
    public function massTrash($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    /*Mass restore*/
    public function massRestore($ids)
    {
        return $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
    }

    /*Mass destroy*/
    public function massDestroy($ids)
    {
        return $this->model->withTrashed()->whereIn('id', $ids)->forceDelete();
    }

    /*Empty Trash*/
    public function emptyTrash()
    {
        return $this->model->onlyTrashed()->forceDelete();
    }
}
