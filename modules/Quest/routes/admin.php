<?php

Route::get('quests', 'QuestController@index')->name('quests.index');
Route::post('quests/create', 'QuestController@index')->name('quests.create');
Route::delete('quests', 'QuestController@destroy')->name('quests.destroy');
