<?php

Route::get('language-test/{lang}/{locale}', function ($lang, $locale) {
    echo "<strong>".App::getLocale()."</strong>:" . " " . __($lang);
});
