<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($langID)
    {

        $languages = config('languages');
        $languagesKeys  = array_column($languages,'ISO 639-1');
        $langDefault  = $languages[0];

        $newLang = $langDefault['ISO 639-1'];
        if ( in_array($langID,$languagesKeys)) {
            $newLang = $langID;
        }

        session()->put('language',$newLang);
        return redirect()->back();
    }

    public function getLanguage()
    {
        $languages = config('languages');
        $langDefault = $languages[0];

        $langID = app()->getLocale();
        $langKey = array_search($langID, array_column($languages,'ISO 639-1'));
        $lang = $languages[$langKey];


        return [ $langDefault, $lang ];
    }


    public function getAttributeTrans( $model, $attribute )
    {
        list($langDefault,$lang) =  $this->getLanguage();

        $trans = $model->{$attribute};

        if ($lang['ISO 639-1'] != $langDefault['ISO 639-1']) {
            $trans = $model->{$attribute.'_'.$lang['ISO 639-2']};
        }
        return $trans;
    }
}
