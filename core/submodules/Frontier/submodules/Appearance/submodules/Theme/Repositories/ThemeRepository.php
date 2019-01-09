<?php

namespace Theme\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rule;
use League\CommonMark\CommonMarkConverter;
use Parsedown;
use Parsedown\Extensions\TableOfContents\TableOfContents;
use Pluma\Support\Repository\Repository;
use Role\Models\Role;
use User\Models\User;

class ThemeRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = User::class;

    /**
     * The User model type.
     * Used for module specific users.
     *
     * @var string
     */
    protected $usertype = 'user';

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:themes',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
        ];
    }

    /**
     * Retrieve the theme documentations.
     *
     * $param  string $docsPath
     * @return \Illuminate\Support\Collection
     */
    public function docs($docsPath = null): Collection
    {
        return Cache::rememberForever('documentations:components', function () use ($docsPath) {
            $files = File::glob($docsPath ?? base_path('docs/Components/*.md'));

            foreach ($files as $i => $file) {
                $name = pathinfo(basename($file), PATHINFO_FILENAME);
                $docs[$name] = new HtmlString($this->parsedown()->text(file_get_contents($file)));
                $docs[$name]->toc = new HtmlString($this->toc(file_get_contents($file), $name)->toString());
            }

            return collect($docs ?? []);
        });
    }

    /**
     * The Parsedown instance.
     *
     * @return \Parsedown
     */
    protected function parsedown()
    {
        return new Parsedown();
    }

    /**
     * The TableOfContents instance.
     *
     * @param  string $file
     * @param  string $name
     * @return \Parsedown\Extensions\TableOfContents\TableOfContents
     */
    protected function toc($file, $name)
    {
        return Cache::rememberForever('documentations:toc/'.$name, function () use ($file) {
            return new TableOfContents($file);
        });
    }
}
