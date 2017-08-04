<?php

namespace Role\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Role\Models\Grant;

class GrantController extends APIController
{
    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $resources = Grant::all();

        return response()->json($resources);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $grant = new Grant();
            $grant->name = $request->input('name');
            $grant->code = $request->input('code');
            $grant->description = $request->input('description');
            $grant->permissions()->sync(collect($request->input('permissions')?$request->input('permissions'):[])->pluck('id')->toArray());
            $grant->save();
        } catch (Exception $e) {
            return response()->json(array_merge($this->errorResponse, ['text' => "[ERROR] Mass Assignment Exception: {$e->getMessage()}"]));
        }

        $this->successResponse += ['data' => $grant];
        return response()->json($this->successResponse);
    }

    /**
     * Get the resource by id
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function find(Request $request)
    {
        $resource = Grant::findOrFail($request->input('id'));

        return response()->json($resource);
    }

    public function update(Request $request)
    {
        try {
            $grant = Grant::find($request->input('id'));
            $grant->name = $request->input('name');
            $grant->code = $request->input('code');
            $grant->description = $request->input('description');
            $grant->permissions()->sync(collect($request->input('permissions'))->pluck('id')->toArray());
            $grant->save();
        } catch (\Illuminate\Database\Eloquent\MassAssignmentException $e) {
            return response()->json(array_merge($this->errorResponse, ['text' => "[ERROR] Mass Assignment Exception: {$e->getMessage()}"]));
        }  catch (Exception $e) {
            return response()->json(array_merge($this->errorResponse, ['text' => "[ERROR] Mass Assignment Exception: {$e->getMessage()}"]));
        }

        $this->successResponse += ['data' => $grant];
        return response()->json($this->successResponse);
    }

    public function remove($id)
    {
        try {
            $grant = Grant::findOrFail($id);
            $grant->delete();

        } catch (Exception $e) {
            return response()->json(array_merge($this->errorResponse, ['text' => "[ERROR] Mass Assignment Exception: {$e->getMessage()}"]));
        }

        $this->successResponse += ['data' => $grant];
        return response()->json($this->successResponse);
    }
}
