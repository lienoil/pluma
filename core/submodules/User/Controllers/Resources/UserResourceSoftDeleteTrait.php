<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;
use User\Models\User;

trait UserResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = User::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("User::users.index")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $users = User::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($users as $user) {
            $user->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $users = User::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($users as $user) {
            $user->forceDelete();
        }

        return back();
    }
}
