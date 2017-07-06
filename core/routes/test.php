<?php

Route::get('lt/{lang}/{locale}', function ($lang, $locale) {
    echo "<strong>".App::getLocale()."</strong>:" . " " . __($lang);
});
