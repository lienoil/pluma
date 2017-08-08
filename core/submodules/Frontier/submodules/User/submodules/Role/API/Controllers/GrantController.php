<?php

namespace Role\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Role\Models\Grant;
use Role\Models\Permission;

class GrantController extends APIController
{
    /**
     * Search the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';

        $permissions = Grant::search($search)->orderBy($sort, $order)->paginate($take);

        return response()->json($permissions);
    }

    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';

        $permissions = Grant::search($search)->orderBy($sort, $order)->paginate($take);

        return response()->json($permissions);
    }

    /**
     * Gets the permissions.
     *
     * @param  array $modules
     * @return void
     */
    public function permissions($modules = null)
    {
        $permissions = Permission::all();

        return response()->json($permissions);
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
            $grant->save();
            $grant->permissions()->sync(collect($request->input('permissions'))->pluck('id')->toArray());
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
