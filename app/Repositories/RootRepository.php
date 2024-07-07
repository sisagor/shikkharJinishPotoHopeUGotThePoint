<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RootRepository
{

    public function all();

    public function trashOnly();

    public function find($id);

    public function findTrash($id);

    public function findBy($column, $value);

    public function recent($limit);

    public function store(Request $request);

    public function update(Request $request, $model);

    public function trash($model);

    public function restore($model);

    public function destroy($model);
}
