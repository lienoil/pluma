<?php

namespace Profile\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Profile\Models\User;
use Profile\Requests\ProfileRequest;

class ProfileController extends AdminController
{
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $handle
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $handle)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->first();

        return view("Theme::profiles.show")->with(compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $handle
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $handle)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->firstOrFail();

        return view("Theme::profiles.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Profile\Requests\ProfileRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('ProfileController.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::profiles.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        //

        return redirect()->route('ProfileController.trash');
    }
}
