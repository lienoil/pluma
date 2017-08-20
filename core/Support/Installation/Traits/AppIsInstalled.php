<?php

namespace Pluma\Support\Installation\Traits;

use Illuminate\Support\Facades\DB;

trait AppIsInstalled
{
    /**
     * If app is installed.
     *
     * @var boolean
     */
    protected $installed = true;

    /**
     * Performs tests to check if app is installed.
     *
     * @return bool
     */
    public function appIsInstalled()
    {
        try {
            DB::connection()->getPdo();

            if (file_exists(storage_path('.install'))) {
                $this->installed = false;
            }
        } catch (\PDOException $e) {
            $this->installed = false;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->installed = false;
        }

        return $this->installed;
    }
}
