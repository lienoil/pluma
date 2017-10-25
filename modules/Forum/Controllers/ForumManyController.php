<?php

namespace Forum\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Forum\Models\Forum;

class ForumManyController extends AdminController
{
    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('forums') as $id) {
            $forum = Forum::onlyTrashed()->findOrFail($id);
            $forum->restore();
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
        foreach ($request->input('forums') as $id) {
            $forum = Forum::findOrFail($id);
            $forum->delete();
        }

        return redirect()->route('forums.index');
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->input('forums') as $id) {
            $forum = Forum::withTrashed()->findOrFail($id);
            $forum->forceDelete();
        }

        return back();
    }
}
