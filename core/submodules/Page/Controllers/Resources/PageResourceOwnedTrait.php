<?php

namespace Page\Controllers\Resources;

use Illuminate\Http\Request;

trait PageResourceOwnedTrait
{
    /**
     * Show list of owned resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function owned(Request $request)
    {
        if ($request->user()->isSuperAdmin()) {
            return redirect()->route('pages.index');
        }

        $resources = $this->repository
            ->search($request->all())
            ->onlyOwned()
            ->paginate();

        return view('Page::admin.owned')->with(compact('resources'));
    }
}
