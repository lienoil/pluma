<?php

namespace Frontier\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;

class Breadcrumbs
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $table
     * @return mixed
     */
    public function handle($request, Closure $next, $table = null)
    {
        if (class_exists($table)) {
            $tableName = with(new $table)->getTable();
            $id = $request->route(str_singular($tableName));
            $crumb = $table::find($id);
            if ($crumb) {
                $crumb = $crumb->crumb;
                $request->route()->setParameter('breadcrumb', $crumb);
            }
        }

        return $next($request);
    }
}
