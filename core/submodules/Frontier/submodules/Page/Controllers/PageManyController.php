<?php

namespace Page\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Page\Models\Page;

class PageManyController extends AdminController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('pages') as $id) {
            $page = Page::findOrFail($id);
            $page->delete();
        }

        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('pages') as $id) {
            $page = Page::onlyTrashed()->findOrFail($id);
            $page->restore();
        }

        return back();
    }
}
