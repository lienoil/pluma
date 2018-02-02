<?php

use Crowfeather\Dictionary\ObsceneWord;

if (! function_exists('filter_banned_words')) {
    /**
     * Filters the forbidden words.
     *
     * @param  string $blurb
     * @return string
     */
    function filter_obscene_words($blurb)
    {
        $blurb = str_replace('<', ' <', $blurb);
        $blurb = str_replace('>', '> ', $blurb);
        $blurb = explode(' ', $blurb);

        $replacer = new ObsceneWord();
        $replacer->setDictionaryFromArray(
            settings('banned_words', ['fuck'])
        );

        foreach ($blurb as &$word) {
            if ($replacer->setText($word)->checkAmong()) {
                $word = $replacer->censor($word);
            }
        }

        return implode(" ", $blurb);
    }
}
