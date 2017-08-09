<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Grant;
use Role\Models\Permission;
use Role\Requests\GrantRequest;

class GrantManyController extends AdminController
{
    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('grants') as $id) {
            $grant = Grant::onlyTrashed()->findOrFail($id);
            $grant->restore();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('grants') as $id) {
            $grant = Grant::findOrFail($id);
            $grant->delete();
        }

        return redirect()->route('grants.index');
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->input('grants') as $id) {
            $grant = Grant::withTrashed()->findOrFail($id);
            $grant->forceDelete();
        }

        return redirect()->route('grants.trash');
    }
}
