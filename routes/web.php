<?php

Route::get('/{any}', function () {
  return view('car');
})->where('any', '.*');
