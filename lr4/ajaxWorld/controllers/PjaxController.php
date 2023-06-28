<?php


namespace app\controllers;

use app\models\City;
use app\models\CityLanguage;
use app\models\Country;
use app\models\Continent;
use app\models\Region;
use app\models\RegionLanguage;
use app\models\WorldForm;
use Yii;
use yii\web\Controller;

class PjaxController extends Controller
{
    public function actionWorldForm()
    {
        $model = new WorldForm();
        $continent = null;
        $country1 = null;
        $region = null;
        $regionLang = null;
        $cityLang = null;
        $dataJson = null;
        $city = "Lviv";
        $apiKey = "e525a00caf58572579c3e2723291965b";
        if (Yii::$app->request->isPjax) {
            $model->load(Yii::$app->request->post());
            $continent = Continent::find()->where(['continent_id' => $model->continent_id])->one();
            $country1 = Country::find()->where(['country_id' => $model->country_id])->one();
            $region = Region::find()->where(['region_id' => $model->region_id])->one();
            $regionLang = RegionLanguage::find()->where(['region_id' => $model->region_id])->one();
            $city = City::find()->where(['city_id' => $model->city_id])->one();
            $cityLang = CityLanguage::find()->where(['city_id' => $model->city_id])->one();
        }
        $continents = Continent::find()->asArray()->all();

        $country = Country::find()->where(['continent_id' => $continent])->all();

        $region1 = Region::find()->where(['country_id' => $country1])->all();

        $regionLang1 = RegionLanguage::find()->where(['region_id' => $region1])->all();

        $city1 = City::find()->where(['region_id' => $region])->all();

        $cityLang1 = CityLanguage::find()->where(['city_id' => $city1])->all();
        if (Yii::$app->request->isPjax) {
            $url = "http://api.openweathermap.org/data/2.5/weather?q=" . ($cityLang->name_language) . "&lang=ru&units=metric&appid=" . $apiKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $dataJson = json_decode(curl_exec($ch));
        }
        return $this->render('pjax-form', [
            'model' => $model,
            'continents' => $continents,
            'continent' => $continent,
            'country' => $country,
            'country1' => $country1,
            'region' => $region,
            'region1' => $region1,
            'regionLang1' => $regionLang1,
            'regionLang' => $regionLang,
            'city1' => $city1,
            'city' => $city,
            'cityLang' => $cityLang,
            'cityLang1' => $cityLang1,
            'dataJson' => $dataJson,
        ]);
    }
}