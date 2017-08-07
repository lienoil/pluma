<?php

namespace Pluma\Support\Installation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Pluma\Support\Auth\Traits\CreateUser;
use Pluma\Support\Database\Traits\CreateDatabase;
use Pluma\Support\Database\Traits\MigrateDatabase;

class InstallController extends Controller
{
    use CreateDatabase, MigrateDatabase, CreateUser;

    protected $installed = false;

    public function welcome(Request $request)
    {
        if (! File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            write_to_env(['APP_KEY' => generate_random_key()]);
        }

        return view("Install::welcome.welcome");
    }

    public function next(Request $request)
    {
        return view("Install::welcome.next");
    }

    public function write(Request $request)
    {
        try {
            write_to_env($request->all());
        } catch (Whoops\Exception\ErrorException $e) {
            return view("Install::errors.general")->with(compact('e'));
        } catch (\Exception $e) {
            return view("Install::errors.general")->with(compact('e'));
        }


        return redirect()->route('installation.show');
    }

    public function show(Request $request)
    {
        return view("Install::welcome.show");
    }

    public function install(Request $request)
    {
        try {
            $this->db(env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'))->drop()->make();

            $this->migrate(null, $request);

            // $this->seed();

            $this->createRootUser($request);
        } catch (Whoops\Exception\ErrorException $e) {
            return view("Install::errors.general")->with(compact('e'));
        } catch (\Exception $e) {
            return view("Install::errors.general")->with(compact('e'));
        }

        return redirect()->route('installation.last');
    }

    public function last(Request $request)
    {
        if (! $this->installed) {
            return redirect()->route('installation.welcome');
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
