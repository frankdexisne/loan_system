<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class BaseCrudController extends Controller
{
    /**
     * Model for this crud operation.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $module;
    /**
     * Model for this crud operation.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Model's base query for this pagination.
     * Defaults to $this->model->query().
     *
     * @var Illuminate\Database\Eloquent\Builder
     */
    protected $modelQuery;

    /**
     * Request validation rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Request validation rules.
     *
     * @var array
     */
    protected $permissions = [];

    /**
     * Exclude this params from request when getting params for store and update.
     *
     * @var array
     */
    protected $except = ['_token'];

    /**
     * Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $search_fields = [];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index()
    {
        return view($this->module . '.index');
    }

    protected function jsonData()
    {
        $this->filterJsonData();

        return [
            'data' => $this->modelQuery->get()
        ];
    }

    protected function filterJsonData(){
        return;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store()
    {
        $raw_data = request()->validate($this->rules);
        if($raw_data){
            $data = array_merge(request()->all(), $this->appendOnStore(request()));
            return $this->model->create($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function appendOnStore($request)
    {
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function show($id)
    {
        $data = $this->model->findOrFail($id);
        if($data) return $data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update($id)
    {
        $record = $this->model->findOrFail($id);
        if($record && $raw_data = request()->validate($this->rules))
        {
            $record->update($raw_data);
            $record->refresh();
            return $record;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        if($record){
            try {
                $record->delete();
            } catch (QueryException $e) {
                if ($e->errorInfo[0] == 23000 && $e->errorInfo[1] == 1451) {
                    throw ValidationException::withMessages([
                        'id' => [
                            'Cannot delete data, already in use.'
                        ]
                    ]);
                }
                throw $e;
            }
        }

    }


}
