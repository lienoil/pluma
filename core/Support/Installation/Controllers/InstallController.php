<?php

namespace Pluma\Support\Installation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Pluma\Support\Database\Traits\CreateDatabase;
use Pluma\Support\Database\Traits\MigrateDatabase;

class InstallController extends Controller
{
    use CreateDatabase, MigrateDatabase;

    public function welcome(Request $request)
    {
        return view("Install::welcome.welcome");
    }

    public function next(Request $request)
    {
        return view("Install::welcome.next");
    }

    public function install(Request $request)
    {
        try {
            config($request->all());
            DB::connection()->getPdo();
        } catch (\InvalidArgumentException $e) {
            $db = $this->db(config('DB_NAME'))->drop()->make();
        }

        if (isset($db) && $db) {

            $this->migrate();
            // $this->seed();

            session()->flash('type', "success");
            session()->flash('message', "Database successfully created");

            return redirect()->route('installation.last');
        }

        return abort(500);
    }

    public function last(Request $request)
    {
        $this->clean();

        return view("Install::welcome.last")->with(['config' => config()]);
    }

    public function clean()
    {
        return File::delete(base_path('.install'));
    }
}
