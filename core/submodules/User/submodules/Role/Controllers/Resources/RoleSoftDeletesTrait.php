<?php

namespace Role\Controllers\Resources;

use Illuminate\Http\Request;

trait RoleSoftDeletesTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = $this->repository()
            ->search($request->all())
            ->onlyTrashed()
            ->paginate();

        return view('Theme::roles.trashed')->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->repository()->restore(
            $request->has('id') ? $request->input('id') : [$id]
        );

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $this->repository()->delete(
            $request->has('id') ? $request->input('id') : [$id]
        );

        return redirect()->route('roles.trashed');
    }
}
