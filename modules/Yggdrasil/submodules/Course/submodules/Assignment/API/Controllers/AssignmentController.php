<?php

namespace Assignment\API\Controllers;

use Assignment\Models\Assignment;
use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;

class AssignmentController extends APIController
{
    /**
     * Search the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly') : false;
        $order = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = Assignment::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $resources->paginate($take);

        return response()->json($resources);
    }

    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly') : false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';

        $resources = Assignment::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resource = $resources->get();

        return response()->json($resources);
    }

    public function destroy(Request $request, $id)
    {
        $assingment = Assignment::findOrFail($id);
        $assingment->delete();

        return response()->json($this->successResponse);
    }

    /**
     * Remove the speicified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illumiate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $assingment = Assignment::findOrFail($id);
        $assingment->delete();

        return response()->json($this->successResponse);
    }

    /**
     * Copy the resource as a new resource.
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clone(Request $request, $id)
    {
        $assingment = Assignment::findOrFail($id);

        $clone = new Assignment();
        $clone->name = $assingment->name;
        $clone->code = "{$assingment->code}-clone-{$id}";
        $clone->description = $assingment->description;
        $clone->save();
        $clone->permissions()->attach($assingment->permissions->pluck('id')->toArray());

        return response()->json($this->successResponse);
    }
}
