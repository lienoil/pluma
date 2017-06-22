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

    protected $installed = false;

    public function welcome(Request $request)
    {
        return view("Install::welcome.welcome");
    }

    public function next(Request $request)
    {
        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
        }

        return view("Install::welcome.next");
    }

    public function install(Request $request)
    {
        write_to_env($request->all());

        // config()->set('env', $request->all());

        $db = $this->db(env('DB_DATABASE'))->drop()->make();

        $this->migrate();
        // $this->seed();

        $this->installed = true;

        return redirect()->route('installation.last');
    }

    public function last(Request $request)
    {
        if ($this->installed) {
            return redirect()->route('installation.next');
        }

        $this->clean();

        return view("Install::welcome.last")->with(['config' => config('env')]);
    }

    public function clean()
    {
        File::delete(base_path('bootstrap/cache/services.php'));
        File::delete(base_path('.install'));
    }
}
