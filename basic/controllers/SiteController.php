<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\RuCity2;
use app\models\CityFromWeathe;
use app\models\CityFromWeathe2;
use app\models\CityFromFile;
use app\models\CityFromFile2;
use app\models\CityFromFileUnic;
use app\models\CrimCity;
use app\models\Region;
use app\models\District;
use app\models\LogData;
use app\models\ErrorData;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Search;
use app\Cmfcmf\OpenWeatherMap;
use app\Cmfcmf\OpenWeatherMap\Exception as OWMException;

error_reporting(0);

class SiteController extends Controller
{
    const VIEW_FORCAST_1_3DAYS = 1;
    const VIEW_FORCAST_4_5DAYS = 2;
    const VIEW_FORCAST_6DAYS = 3;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($city = NULL, $district = NULL, $region = NULL)
    {
        //set_time_limit(60000);
                
        // Language of data (try your own language here!):
        $lang = 'ru';
        // Units (can be 'metric' or 'imperial' [default]):
        $units = 'metric';
        //$units = 'imperial';

        $api = 'eaeaeae2be4a7ff45e9a15bc46dc9929';

        $owm = new OpenWeatherMap();

        //search
        $model_search = new Search();
        /*if ($model_search->load(Yii::$app->request->get())) {
            $array_query = explode(',', $model_search->query);
            $array_search_city = UsCities::find()->where(['name' => trim($array_query[0]),'state' => trim($array_query[1])])->select(['id_city'])->asArray()->one();
            if ($array_search_city != NULL) {
                
                return $this->redirect(['site/index','state' => trim(strtolower($array_query[1])),'city' =>$array_search_city['id_city']]);
            }
            else{
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to find your city');
                return $this->redirect(['site/index']);
            }
            
        }*/
        //search
        $cache = Yii::$app->cache;
        $cache->flush();
        //array_states
        $array_states = $cache->get('list_state');
        if ($array_states === false) {
            $array_states = Region::find()->where(['and',['not like', 'name', 'Актюбинская область'], ['not like', 'name', 'Атырауская область'], ['not like', 'name', 'Восточно-Казахстанская область'], ['not like', 'name', 'Гомельская область'], ['not like', 'name', 'Гульрипшский район'], ['not like', 'name', 'Донецкая область'], ['not like', 'name', 'Западно-Казахстанская область'], ['not like', 'name', 'Костанайская область'], ['not like', 'name', 'край Мцхета-Мтианети'], ['not like', 'name', 'Луганская область'], ['not like', 'name', 'Могилёвская область'], ['not like', 'name', 'Павлодарская область'], ['not like', 'name', 'Северо-Казахстанская область'], ['not like', 'name', 'Сумская область'], ['not like', 'name', 'Харьковская область'], ['not like', 'name', 'Хачмазский район'], ['not like', 'name', 'Витебская область']])->select(['id','name'])->orderBy(['name' => SORT_ASC])->asArray()->all();
            $cache->set('list_state',$array_states);
        }
        
        //array_states

        //array_for_typeahead
        /*$array_for_typeahead = $cache->get('array_for_typeahead');
        if ($array_for_typeahead === false) {
            $array_for_typeahead = $this->arrayToTypeahead();
            $cache->set('array_for_typeahead',$array_for_typeahead);
        }*/
        
        //array_for_typeahead
        $render_array = array();
        $render_array_total = [
            'array_states' => $array_states,
            //'array_for_typeahead' => $array_for_typeahead,
            //'model_search' => $model_search,
        ];

        if ($city != NULL && $district != NULL && $region != NULL) {
            # code...
        }elseif ($district != NULL && $region != NULL) {
            $model_region = Region::find()->with(['districts'])->where(['id' => trim($region)])->limit(1)->one();
            $model_district = District::find()->where(['id' => trim($district)])->limit(1)->one();
            $cities = RuCity2::find()->where(['region' => $model_region->name, 'district' => $model_district->name])->orderBy(['name' => SORT_ASC])->all();
            $array_render_district = [
                'cities' => $cities, 
                'district' => $model_district,
                'region' => $model_region,
            ];
            $render_array = array_merge($render_array_total,$array_render_district);
            return $this->render('district',$render_array);
        }elseif ($region != NULL) {
            $model_region = Region::find()->with(['districts'])->where(['id' => trim($region)])->limit(1)->one();
            $array_render_index = [
                'region' => $model_region, 
            ];
            $render_array = array_merge($render_array_total,$array_render_index);
            return $this->render('state',$render_array);
        }else{
            
            $weather_moscow = $cache->get('weather_moscow_home');
            if ($weather_moscow === false) {
                $weather_moscow = $owm->getWeather(524901, $units, $lang, $api);
                $cache->set('weather_moscow_home',$weather_moscow,3600);
            }
            $weather_piter = $cache->get('weather_piter_home');
            if ($weather_piter === false) {
                $weather_piter = $owm->getWeather(519690, $units, $lang, $api);
                $cache->set('weather_piter_home',$weather_piter,3600);
            }
            $weather_novosib = $cache->get('weather_novosib_home');
            if ($weather_novosib === false) {
                $weather_novosib = $owm->getWeather(1512086, $units, $lang, $api);
                $cache->set('weather_novosib_home',$weather_novosib,3600);
            }
            $weather_eburg = $cache->get('weather_eburg_home');
            if ($weather_eburg === false) {
                $weather_eburg = $owm->getWeather(1493273, $units, $lang, $api);
                $cache->set('weather_eburg_home',$weather_eburg,3600);
            }
            $weather_nizhny_novgorod = $cache->get('weather_nizhny_novgorod_home');
            if ($weather_nizhny_novgorod === false) {
                $weather_nizhny_novgorod = $owm->getWeather(470012, $units, $lang, $api);
                $cache->set('weather_nizhny_novgorod_home',$weather_nizhny_novgorod,3600);
            }
            $weather_samara = $cache->get('weather_samara_home');
            if ($weather_samara === false) {
                $weather_samara = $owm->getWeather(499099, $units, $lang, $api);
                $cache->set('weather_samara_home',$weather_samara,3600);
            }
            $array_img_wind = array();
            $array_img_wind['moscow'] = $this->getWindDirection($weather_moscow->wind->direction->getValue());
            $array_img_wind['piter'] = $this->getWindDirection($weather_piter->wind->direction->getValue());
            $array_img_wind['novosib'] = $this->getWindDirection($weather_novosib->wind->direction->getValue());
            $array_img_wind['eburg'] = $this->getWindDirection($weather_eburg->wind->direction->getValue());
            $array_img_wind['nizhny_novgorod'] = $this->getWindDirection($weather_nizhny_novgorod->wind->direction->getValue());
            $array_img_wind['samara'] = $this->getWindDirection($weather_samara->wind->direction->getValue());

            $array_render_index = [
                'weather_moscow' => $weather_moscow,
                'weather_piter' => $weather_piter,
                'weather_novosib' => $weather_novosib,
                'weather_eburg' => $weather_eburg,
                'weather_nizhny_novgorod' => $weather_nizhny_novgorod,
                'weather_samara' => $weather_samara,
                'array_img_wind' => $array_img_wind,
            ];
            $render_array = array_merge($render_array_total,$array_render_index);
            return $this->render('index',$render_array);
        }

        
       /* 
        if ($request->get('state') !== NULL && $request->get('city') !== NULL) {
            //city
            $id_city = $request->get('city');
            $model_city = $cache->get('city_'.$id_city);
            if ($model_city === false) {
                $model_city = UsCities::find()->where(['id_city' => $id_city])->limit(1)->one();
                $cache->set('city_'.$id_city,$model_city);
            }
            $weather_now = $cache->get('weather_now_'.$id_city);            
            if ($weather_now === false) {
                $weather_now = $owm->getWeather($id_city, $units, $lang, $api);
                $cache->set('weather_now_'.$id_city,$weather_now,3600);
            }
            
            $img_wind_now = $this->getWindDirection($weather_now->wind->direction->getValue());

            $weather_ferecasts = $cache->get('weather_ferecasts_1day_'.$id_city);
            if ($weather_ferecasts === false) {
                $weather_ferecasts = $owm->getWeatherForecast($id_city, $units, $lang, $api,1);
                $cache->set('weather_ferecasts_1day_'.$id_city,$weather_ferecasts,3600);
            }
            //create array temperature chart
            $data_chart = $this->arrayTemp2($weather_ferecasts,self::VIEW_FORCAST_1_3DAYS);

            $data_pressure = $this->arrayPressure($weather_ferecasts,self::VIEW_FORCAST_1_3DAYS);

            $data_humidity = $this->arrayHumidity($weather_ferecasts,self::VIEW_FORCAST_1_3DAYS);

            $data_wind = $this->arrayWind($weather_ferecasts,self::VIEW_FORCAST_1_3DAYS);

            $near_city = $cache->get('near_city_'.$id_city);
            if ($near_city === false) {
                $near_city = $this->nearCity($model_city,0.1);
                $cache->set('near_city_'.$id_city,$near_city);
            }
            if ($request->get('day') !== NULL) {
                $n_days = trim($request->get('day'));
                
                $weather_ferecasts = $cache->get('weather_ferecasts_'.$n_days.'day_'.$id_city);
                if ($weather_ferecasts === false) {
                    $weather_ferecasts = $owm->getWeatherForecast($id_city, $units, $lang, $api,$n_days);
                    $cache->set('weather_ferecasts_'.$n_days.'day_'.$id_city,$weather_ferecasts,3600);
                }
                
                if ($n_days < 6) {
                    $data_chart = $this->arrayTemp2($weather_ferecasts,self::VIEW_FORCAST_4_5DAYS);

                    $data_pressure = $this->arrayPressure($weather_ferecasts,self::VIEW_FORCAST_4_5DAYS);

                    $data_humidity = $this->arrayHumidity($weather_ferecasts,self::VIEW_FORCAST_4_5DAYS);

                    $data_wind = $this->arrayWind($weather_ferecasts,self::VIEW_FORCAST_4_5DAYS);
                }
                else{
                    $data_chart = $this->arrayTemp2($weather_ferecasts,self::VIEW_FORCAST_6DAYS);
                    //var_dump($data_chart);
                    //die();
                    
                    $data_pressure = $this->arrayPressure($weather_ferecasts,self::VIEW_FORCAST_6DAYS);

                    $data_humidity = $this->arrayHumidity($weather_ferecasts,self::VIEW_FORCAST_6DAYS);

                    $data_wind = $this->arrayWind($weather_ferecasts,self::VIEW_FORCAST_6DAYS);
                }
                
                

                $array_render_city = [
                    'model_city' => $model_city,
                    'model_state' => $model_state,
                    'data_chart' => $data_chart,
                    'data_pressure' => $data_pressure,
                    'data_humidity' => $data_humidity,
                    'data_wind' => $data_wind,
                    'near_city' => $near_city,
                    'n_days' => $n_days,
                ];
                $render_array = array_merge($render_array_total,$array_render_city);
                return $this->render('day_city',$render_array);
            }
                        
            //create array temperature chart
            $array_render_city = [
                'model_city' => $model_city,
                'model_state' => $model_state,
                'weather_now' => $weather_now,
                'img_wind_now' => $img_wind_now,
                'weather_ferecasts' => $weather_ferecasts,
                'data_chart' => $data_chart,
                'data_pressure' => $data_pressure,
                'data_humidity' => $data_humidity,
                'data_wind' => $data_wind,
                'near_city' => $near_city,
            ];
            $render_array = array_merge($render_array_total,$array_render_city);
            return $this->render('city',$render_array);

            //die();
            //city
        }
        else if ($request->get('state') != NULL) {
            //state
            $code_state = strtoupper($request->get('state'));
            $model_state = $cache->get('state_'.$code_state);
            if ($model_state === false) {
                $model_state = UsStates::find()->where(['code' => $code_state])->one();    
                $cache->set('state_'.$code_state,$model_state);
            }
            
            if ($model_state != NULL) {
                $array_cities = $cache->get('array_cities_state_'.$code_state);
                if ($array_cities === false) {
                    $array_cities = $model_state->getCities()->asArray()->all();
                    $cache->set('array_cities_state_'.$code_state,$array_cities);
                }
                $array_capital = $cache->get('array_capital_state_'.$code_state);
                if ($array_capital === false) {
                    $array_capital = $model_state->getCity($model_state->capital)->one();//delete asArray
                    $cache->set('array_capital_state_'.$code_state,$array_capital);
                }
                $weather_capital = $cache->get('weather_capital_state_'.$code_state);
                if ($weather_capital === false) {
                    $weather_capital = $owm->getWeather($array_capital->id_city, $units, $lang, $api);    
                    $cache->set('weather_capital_state_'.$code_state,$weather_capital,3600);
                }
                $img_wind = $this->getWindDirection($weather_capital->wind->direction->getValue());
            }
            else{
                // выбросить исключение
            }

            
            
            $array_render_state = [
                'weather_capital' => $weather_capital,
                'model_state' => $model_state,
                'model_capital' => $array_capital,
                'img_wind' => $img_wind,
                'array_cities' => $array_cities,
            ];
            $render_array = array_merge($render_array_total,$array_render_state);
            return $this->render('state',$render_array);
            //state
        }
        else{
            
            //home page
            $weather_new_york = $cache->get('weather_new_york_home');
            if ($weather_new_york === false) {
                $weather_new_york = $owm->getWeather(5128581, $units, $lang, $api);
                $cache->set('weather_new_york_home',$weather_new_york,3600);
            }
            $weather_los_angeles = $cache->get('weather_los_angeles_home');
            if ($weather_los_angeles === false) {
                $weather_los_angeles = $owm->getWeather(5368361, $units, $lang, $api);
                $cache->set('weather_los_angeles_home',$weather_los_angeles,3600);    
            }
            $weather_chicago = $cache->get('weather_chicago_home');
            if ($weather_chicago === false) {
                $weather_chicago = $owm->getWeather(4887398, $units, $lang, $api);
                $cache->set('weather_chicago_home',$weather_chicago,3600);
            }
            $weather_houston = $cache->get('weather_houston_home');
            if ($weather_houston === false) {
                $weather_houston = $owm->getWeather(4699066, $units, $lang, $api);
                $cache->set('weather_houston_home',$weather_houston,3600);
            }
            $weather_philadelphia = $cache->get('weather_philadelphia_home');
            if ($weather_philadelphia === false) {
                $weather_philadelphia = $owm->getWeather(4560349, $units, $lang, $api);
                $cache->set('weather_philadelphia_home',$weather_philadelphia,3600);
            }
            $weather_phoenix = $cache->get('weather_phoenix_home');
            if ($weather_phoenix === false) {
                $weather_phoenix = $owm->getWeather(5308655, $units, $lang, $api);
                $cache->set('weather_phoenix_home',$weather_phoenix,3600);
            }
            


            $array_img_wind = array();

            $array_img_wind['new_york'] = $this->getWindDirection($weather_new_york->wind->direction->getValue());
            $array_img_wind['los_angeles'] = $this->getWindDirection($weather_los_angeles->wind->direction->getValue());
            $array_img_wind['chicago'] = $this->getWindDirection($weather_chicago->wind->direction->getValue());
            $array_img_wind['houston'] = $this->getWindDirection($weather_houston->wind->direction->getValue());
            $array_img_wind['philadelphia'] = $this->getWindDirection($weather_philadelphia->wind->direction->getValue());
            $array_img_wind['phoenix'] = $this->getWindDirection($weather_phoenix->wind->direction->getValue());

            
            $array_render_index = [
                'weather_new_york' => $weather_new_york,
                'weather_los_angeles' => $weather_los_angeles,
                'weather_chicago' => $weather_chicago,
                'weather_houston' => $weather_houston,
                'weather_philadelphia' => $weather_philadelphia,
                'weather_phoenix' => $weather_phoenix,
                'array_img_wind' => $array_img_wind,
            ];
            $render_array = array_merge($render_array_total,$array_render_index);
            return $this->render('index',$render_array);
            //home page
            
        }*/

        //$list = RuCity2::find()->where(['between','id',90000,118569])->all();
        foreach ($list as $city) {
            
            $this->district_table($city->district, $this->region_table($city->region));

        }

        //echo "test";
        //$this->txtToDatabase('ua');
        //$this->jsonToDatabase('ua');
        //var_dump(RuCity::find()->where(['lat' => 58.5458])->all());
        //$list = CityFromFile2::find()->where(['between','id',7567,8997])->all();
        //$list = CityFromFile::find()->where(['id' => 430005])->all();
        /*if ($list != NULL) {
            foreach ($list as $item) {
                //log
                $log = new LogData();
                $log->id_obj = $item->id;
                $log->save();
                //log
                $old_rec = RuCity2::find()->where(['lon' => $item->coord_lon, 'lat' => $item->coord_lat])->all();
                //var_dump($this->backGeoYandex($item->coord_lon,$item->coord_lat));
                if ($old_rec == NULL) {
                    $geo = $this->backGeoYandex($item->coord_lon,$item->coord_lat);
                    if (is_array($geo)) {
                        if ($geo['locality'] != NULL) {
                            $check_duble = RuCity2::find()->where(['name' => $geo['locality']['name'], 'district' => $geo['locality']['district'], 'region' => $geo['locality']['region']])->all();

                            if ($check_duble == NULL) {
                                $meteo = $this->searchNearMeteo($item->coord_lon,$item->coord_lat);
                                $new_rec = new RuCity2();
                                $new_rec->city_id = $meteo->id_city;
                                $new_rec->name = $geo['locality']['name'];
                                $new_rec->district = $geo['locality']['district'];
                                $new_rec->region = $geo['locality']['region'];
                                $new_rec->lon = $item->coord_lon;
                                $new_rec->lat = $item->coord_lat;
                                $new_rec->save();    

                                
                            }
                        }
                        else{
                            //error
                            $error = new ErrorData();
                            $error->id_obj = $item->id;
                            $error->save();
                            //error
                        }
                    }
                    else{
                        
                        //error
                        $error = new ErrorData();
                        $error->id_obj = $item->id;
                        $error->save();

                        //error
                    }
                    /*else{
                        
                    }*/
                    
                    
        /*        }
                //die();   
            }
        }*/
        
        /*if ($list != NULL) {
            foreach ($list as $item) {
                $geo = $this->backGeoYandex($item->coord_lon,$item->coord_lat);
                $meteo = $this->searchNearMeteo($item->coord_lon,$item->coord_lat);
                $new_rec = new RuCity();
                $new_rec->city_id = $meteo->id_city;
                $new_rec->name = $geo['name'];
                $new_rec->district = $geo['district'];
                $new_rec->region = $geo['region'];
                $new_rec->lon = $item->coord_lon;
                $new_rec->lat = $item->coord_lat;
                $new_rec->save();
            }
        }*/

        
        
        //var_dump($this->backGeoYandex(99.1136,54.7433)->response->GeoObjectCollection->featureMember);
        //var_dump(CityFromWeathe2::find()->all());
    }

    
    public function actionAutocompleteCity()
    {
        
            if(Yii::$app->request->isAjax){
                $get_data = Yii::$app->request->get(); 
                
                $arr_query = $this->strToArray($this->deleteComma(trim($get_data['q'])));
                

                if ($get_data['q'] != NULL) {
                    $result = (new RuCity2())->findBySearch($arr_query[0], $arr_query[1], $arr_query[2]);    
                }
                
                $resp = [];
                if ($result != NULL) {
                    $n_res = 0;
                    foreach ($result as $item) {
                        $resp[$n_res]['value'] = $item['name'].', '.$item['district'].', '.$item['region'];
                            $resp[$n_res]['label'] = $item['name'].', '.$item['district'].', '.$item['region'];
                            $resp[$n_res]['id'] = $item['id'];
                            $n_res++;
                        }
                     }
                     
                     return Json::encode($resp);
            }
        
    }
    


    public function jsonToDatabase($country)
    {   

        $country = strtoupper($country);

        $file_name = Yii::$app->basePath.'/weatherdata/city.list.json';
        

        
        if (file_exists($file_name)) {
            $file_json = file($file_name);    
            
            $n_cities = 0;

            foreach ($file_json as $json) {
                $city_data = Json::decode($json);

                if ($city_data['country'] == $country) {
                    $new_model_city = new CityFromWeathe2();
                    $new_model_city->id_city = $city_data['_id'];
                    $new_model_city->name = $city_data['name'];
                    $new_model_city->country = $city_data['country'];
                    $new_model_city->coord_lon = $city_data['coord']['lon'];
                    $new_model_city->coord_lat = $city_data['coord']['lat'];

                    if ($new_model_city->save()) {
                        $n_cities++;

                    }
                }
                

            }
            
        }
        return $n_cities;

    }

    public function txtToDatabase($country)
    {   
        set_time_limit(6000);
        //$country = strtoupper($country);

        $file_city = Yii::$app->basePath.'/weatherdata/worldcitiespop-19.txt';

        
        if (file_exists($file_city)) {

            $file_txt = file($file_city);
            
            $n_cities = 0;


            foreach ($file_txt as $line) {
                $array_data = explode(',', $line);                
                //var_dump($array_data);
//                die();
                if ($array_data[0] == $country && $array_data[3] == 11) {
                    $new_model_city = new CityFromFile2();
                    $new_model_city->name = $array_data[1];
                    $new_model_city->name_other = $array_data[2];
                    $new_model_city->state = $array_data[3];
                    $new_model_city->coord_lat = $array_data[5];
                    $new_model_city->coord_lon = $array_data[6];
                    

                    if ($new_model_city->save()) {
                        $n_cities++;

                    }
                }
                

            }
            
        }
        return $n_cities;

    }


    /**
     * Get curent weather.
     * 
     * @param integer $id
     * @return array.
     */
    public function createReadyCitiesTable()
    {   
        set_time_limit(6000);
        $n_cities = 0;
        $array_citie_time2 = UsCitiesTime2::find()->asArray()->all();
        if ($array_citie_time2 != NULL) {
            foreach ($array_citie_time2 as $citie_time2) {

                $lon_min = round($citie_time2['coord_lon'],2)-0.03;
                $lon_max = round($citie_time2['coord_lon'],2)+0.02;

                $lat_min = round($citie_time2['coord_lat'],2)-0.03;
                $lat_max = round($citie_time2['coord_lat'],2)+0.02;
                
                $array_city_time1 = UsCitiesTime1::find()->where(['and',['name' => $citie_time2['name']],['between','coord_lon',$lon_min,$lon_max],['between','coord_lat',$lat_min,$lat_max]])->asArray()->one();
                if ($array_city_time1 != NULL) {
                    $new_model_city = new UsCities();
                    $new_model_city->name = $array_city_time1['name'];
                    $new_model_city->id_city = $array_city_time1['id_city'];
                    $new_model_city->state = $citie_time2['state'];
                    $new_model_city->country = $array_city_time1['country'];
                    $new_model_city->coord_lon = (float)$array_city_time1['coord_lon'];
                    $new_model_city->coord_lat = (float)$array_city_time1['coord_lat'];
                    
                    
                    if ($new_model_city->save()) {
                        $n_cities++;

                    }
                    
                }
            }
        }
        return $n_cities;
        
    }

    public function searchNearMeteo($lon,$lat)
    {
        $delta = 0.01;
        
        while ($delta <= 1) {
            $min_lon = $lon - $delta;
            $min_lat = $lat - $delta;
            $max_lon = $lon + $delta;
            $max_lat = $lat + $delta;
            $out = CityFromWeathe2::find()->where(['and',['between','coord_lon',$min_lon,$max_lon],['between','coord_lat',$min_lat,$max_lat]])->one();
            if ($out != NULL) {
                break;
            }
            $delta += 0.01;
        }
        return $out;
    }

    /**
     * Get name img for direction.
     * 
     * @param integer $dir
     * @return string.
    */
    public function getWindDirection($dir)
    {
      $img = '';
      if ($dir !== NULL) {
        if ($dir > 5 && $dir < 85) {
          $img = 'deg-north-east.png';
        }
        if ($dir >= 85 && $dir <= 95) {
          $img = 'deg-east.png';
        }
        if ($dir > 95 && $dir < 175) {
          $img = 'deg-south-east.png';
        }
        if ($dir >= 175 && $dir <= 185) {
          $img = 'deg-south.png';
        }
        if ($dir > 185 && $dir < 265) {
          $img = 'deg-south-west.png';
        }
        if ($dir >= 265 && $dir <= 275) {
          $img = 'deg-west.png';
        }
        if ($dir > 275 && $dir < 355) {
          $img = 'deg-north-west.png';
        }
        if ($dir >= 355 || $dir <= 5) {
            $img = 'deg-north.png';
        }
      }
      return $img;
    }

    public function windDirection($dir)
    {
        $img = '';
        if ($dir == 'N') {
            $img = 'deg-north.png';
        }
        if ($dir == 'NE' || $dir == 'NNE' || $dir == 'ENE') {
            $img = 'deg-north-east.png';
        }
        if ($dir == 'E') {
            $img = 'deg-east.png';
        }
        if ($dir == 'SE' || $dir == 'SSE' || $dir == 'ESE') {
            $img = 'deg-south-east.png';
        }
        if ($dir == 'S') {
            $img = 'deg-south.png';
        }
        if ($dir == 'SW' || $dir == 'SSW' || $dir == 'WSW') {
            $img = 'deg-south-west.png';
        }
        if ($dir == 'W') {
            $img = 'deg-west.png';
        }
        if ($dir == 'NW' || $dir == 'NNW' || $dir == 'WNW') {
            $img = 'deg-north-west.png';
        }
        return $img;
    }

    public function arrayToTypeahead()
    {
        $our = array();
        $query_city = UsCities::find()->select(['name','state'])->orderBy(['name' => SORT_ASC]);
        $array_for_typeahead = array();
        if ($query_city != NULL) {
            foreach ($query_city->each() as $city) {
                $our[] = $city->name.', '.$city->state;
            }
        }
        return $our;
    }


    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function arrayTemp($obj,$view=self::VIEW_FORCAST_1_3DAYS)
    {
        $out = array();
        $arr_cat = array();
        $arr_data = array();
        foreach ($obj as $weather) {
            if ($view == self::VIEW_FORCAST_1_3DAYS) {
                $arr_cat[] = '<strong>'.$weather->time->from->format('H:i').'</strong><br>'.$weather->time->from->format('D').'<br>'.$weather->time->from->format('M d');
            }
            if ($view == self::VIEW_FORCAST_4_5DAYS) {
                $arr_cat[] = Html::tag('div',Html::encode($weather->time->from->format('H:i')).' '.Html::tag('b',strtoupper($weather->time->from->format('D'))).' '.$weather->time->from->format('M d'),['class' => 'xLabel-4-5-days']);
            }
            if ($view == self::VIEW_FORCAST_6DAYS) {
                $arr_cat[] = Html::tag('b',strtoupper($weather->time->from->format('D'))).'<br>'.$weather->time->from->format('M d');
            }
            
            if (isset($arr_marker)) {
                unset($arr_marker);
            }
            $arr_marker['y'] = (float)$weather->temperature->now->getValue();
            if ($view == self::VIEW_FORCAST_4_5DAYS) {
                $arr_marker['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_xs.png', true).')';
            }
            else{
                $arr_marker['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_sm.png', true).')';
            }

            $arr_data_temp[] = $arr_marker;

            $arr_dat_pressure[] =  $weather->pressure->getValue();

        }
        $out['cat'] = $arr_cat;
        $out['data_temp'] = $arr_data_temp;
        $out['data_pressure'] = $arr_data_pressure;
        
        return $out;
    }

    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function arrayTemp2($obj,$view)
    {
        $out = array();
        $arr_cat = array();
        $arr_data = array();
        
        foreach ($obj as $weather) {
            
            $arr_ranger[] = [strtotime($weather->time->to->format('Y-m-d H:I'))*1000,(float)$weather->temperature->min->getValue(),(float)$weather->temperature->max->getValue()];
            if ($view != self::VIEW_FORCAST_6DAYS) {
                $local_ave = round(((float)$weather->temperature->now->getValue()));
            }                
            else{
                $local_ave = round(((float)$weather->temperature->max->getValue() + (float)$weather->temperature->min->getValue())/2);    
            }
            
            
            $arr_averages['x'] = strtotime($weather->time->to->format('Y-m-d H:I'))*1000;
            $arr_averages['y'] = $local_ave;

            if ($view == self::VIEW_FORCAST_4_5DAYS) {
                $arr_averages['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_xs.png', true).')';
            }
            else{
                $arr_averages['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_sm.png', true).')';
            }
            $arr_data_temp[] = $arr_averages;


        }
        if ($view != self::VIEW_FORCAST_6DAYS) {
            $out['format_date'] = '{value:%H:%M}<br><b>{value:%a}</b><br>{value:%b %d}';
        }
        else{
            $out['format_date'] = '<b>{value:%a}</b><br>{value:%b %d}';
        }
        $out['ranger'] = $arr_ranger;
        $out['averages'] = $arr_data_temp;
        

        return $out;
    }

    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function arrayPressure($obj,$view=self::VIEW_FORCAST_1_3DAYS)
    {
        $out = array();
        $arr_cat = array();
        $arr_data = array();
        $arr_value = array();
        foreach ($obj as $weather) {
            
            if (isset($arr_marker)) {
                unset($arr_marker);
            }
            $arr_marker['x'] = strtotime($weather->time->to->format('Y-m-d H:I'))*1000;
            $arr_marker['y'] = (float)$weather->pressure->getValue();
            $arr_value[] = $arr_marker['y'];
            //$arr_marker['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_sm.png', true).')';

            $arr_data[] = $arr_marker;

            

        }
        if ($view != self::VIEW_FORCAST_6DAYS) {
            $out['format_date'] = '{value:%H:%M}<br><b>{value:%a}</b><br>{value:%b %d}';
        }
        else{
            $out['format_date'] = '<b>{value:%a}</b><br>{value:%b %d}';
        }
        $out['data_pressure'] = $arr_data;
        $out['min'] = min($arr_value);
        $out['max'] = max($arr_value);

        return $out;
    }

    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function arrayHumidity($obj,$view=self::VIEW_FORCAST_1_3DAYS)
    {
        $out = array();
        $arr_cat = array();
        $arr_data = array();
        $arr_value = array();
        foreach ($obj as $weather) {
            
            if (isset($arr_marker)) {
                unset($arr_marker);
            }
            $arr_marker['x'] = strtotime($weather->time->to->format('Y-m-d H:I'))*1000;
            $arr_marker['y'] = (float)$weather->humidity->getValue();
            $arr_value[] = $arr_marker['y'];
            //$arr_marker['marker']['symbol'] = 'url('.Url::to('/img/'.$weather->weather->icon.'_sm.png', true).')';

            $arr_data[] = $arr_marker;

            

        }
        if ($view != self::VIEW_FORCAST_6DAYS) {
            $out['format_date'] = '{value:%H:%M}<br><b>{value:%a}</b><br>{value:%b %d}';
        }
        else{
            $out['format_date'] = '<b>{value:%a}</b><br>{value:%b %d}';
        }
        $out['data_humidity'] = $arr_data;
        $out['min'] = min($arr_value);
        $out['max'] = max($arr_value);
        return $out;
    }

    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function arrayWind($obj,$view=self::VIEW_FORCAST_1_3DAYS)
    {
        $out = array();
        $arr_cat = array();
        $arr_data = array();
        $arr_value = array();
        
        foreach ($obj as $weather) {
            
            if (isset($arr_marker)) {
                unset($arr_marker);
            }
            $arr_marker['x'] = strtotime($weather->time->to->format('Y-m-d H:I'))*1000;
            $arr_marker['y'] = (float)$weather->wind->speed->getValue();
            $arr_value[] = $arr_marker['y'];
            
            $arr_marker['marker']['symbol'] = 'url('.Url::to('/img/'.$this->windDirection($weather->wind->direction->getUnit()), true).')';

            $arr_data[] = $arr_marker;

        

            

        }
        if ($view != self::VIEW_FORCAST_6DAYS) {
            $out['format_date'] = '{value:%H:%M}<br><b>{value:%a}</b><br>{value:%b %d}';
        }
        else{
            $out['format_date'] = '<b>{value:%a}</b><br>{value:%b %d}';
        }
        $out['data_wind'] = $arr_data;
        $out['min'] = min($arr_value);
        $out['max'] = max($arr_value);

        return $out;
    }


    /**
     * Create array temperature
     * 
     * @param obj $obj
     * @return array.
    */
    public function nearCity($obj,$koef)
    {
        $out = [];
        if ($obj != NULL) {
            $min_lon = $obj->coord_lon-$koef;    
            $max_lon = $obj->coord_lon+$koef;    
            $min_lat = $obj->coord_lat-$koef;    
            $max_lat = $obj->coord_lat+$koef;    
            $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
            $out = $query->all();
            if ($query->count() < 4) {
                $koef += 0.1;
                $min_lon = $obj->coord_lon-$koef;    
                $max_lon = $obj->coord_lon+$koef;    
                $min_lat = $obj->coord_lat-$koef;    
                $max_lat = $obj->coord_lat+$koef;    
                $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                $out = $query->all();
                if ($query->count() < 4) {
                    $koef += 0.1;
                    $min_lon = $obj->coord_lon-$koef;    
                    $max_lon = $obj->coord_lon+$koef;    
                    $min_lat = $obj->coord_lat-$koef;    
                    $max_lat = $obj->coord_lat+$koef;    
                    $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                    $out = $query->all();
                    if ($query->count() < 4) {
                        $koef += 0.1;
                        $min_lon = $obj->coord_lon-$koef;    
                        $max_lon = $obj->coord_lon+$koef;    
                        $min_lat = $obj->coord_lat-$koef;    
                        $max_lat = $obj->coord_lat+$koef;    
                        $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                        $out = $query->all();
                        if ($query->count() < 4) {
                            $koef += 0.1;
                            $min_lon = $obj->coord_lon-$koef;    
                            $max_lon = $obj->coord_lon+$koef;    
                            $min_lat = $obj->coord_lat-$koef;    
                            $max_lat = $obj->coord_lat+$koef;    
                            $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                            $out = $query->all();
                            if ($query->count() < 4) {
                                $koef += 0.1;
                                $min_lon = $obj->coord_lon-$koef;    
                                $max_lon = $obj->coord_lon+$koef;    
                                $min_lat = $obj->coord_lat-$koef;    
                                $max_lat = $obj->coord_lat+$koef;    
                                $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                                $out = $query->all();
                                if ($query->count() < 4) {
                                    $koef += 0.1;
                                    $min_lon = $obj->coord_lon-$koef;    
                                    $max_lon = $obj->coord_lon+$koef;    
                                    $min_lat = $obj->coord_lat-$koef;    
                                    $max_lat = $obj->coord_lat+$koef;    
                                    $query = UsCities::find()->where(['and',['between', 'coord_lon', $min_lon, $max_lon],['between', 'coord_lat', $min_lat, $max_lat],'id != '.$obj->id])->orderBy(['name' =>SORT_ASC]);
                                    $out = $query->all();
                                }
                            }
                        }
                    }
                }

            }
            
        }
        
        return $out;
    }

    public function actionContact()
    {   
        $model_search = new Search();
        $cache = Yii::$app->cache;
        
        
        $array_states = $cache->get('list_state');
        if ($array_states === false) {
            $array_states = UsStates::find()->select(['code','name'])->asArray()->all();
            $cache->set('list_state',$array_states);
        }

        //array_for_typeahead
        $array_for_typeahead = $cache->get('array_for_typeahead');
        if ($array_for_typeahead === false) {
            $array_for_typeahead = $this->arrayToTypeahead();
            $cache->set('array_for_typeahead',$array_for_typeahead);
        }
        
        //array_for_typeahead

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
            'model_search' => $model_search,
            'array_states' => $array_states,
            'array_for_typeahead' => $array_for_typeahead,

        ]);
    }

    public function backGeoYandex($lon,$lat)
    {
        $out = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://geocode-maps.yandex.ru/1.x/?geocode=$lon,$lat&format=json&lang=ru_RU&kind=locality&results=100");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        $res_decode = json_decode($response);
                
        if ($res_decode->response->GeoObjectCollection->featureMember != NULL) {
            $item = $res_decode->response->GeoObjectCollection->featureMember[0];
            $out['locality']['region'] = $item->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
            $out['locality']['district'] = $item->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
            $out['locality']['name'] = $item->GeoObject->metaDataProperty->GeocoderMetaData->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;

        }
        else{
            $out = $res_decode;
        }
        return $out;
        
    }

    public function translit($text, $type = 'front')
    {
        $out = '';
        $translit = array(
   
            'а' => 'a',   'б' => 'b',   'в' => 'v',
  
            'г' => 'g',   'д' => 'd',   'е' => 'e',
  
            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
  
            'и' => 'i',   'й' => 'j',   'к' => 'k',
  
            'л' => 'l',   'м' => 'm',   'н' => 'n',
  
            'о' => 'o',   'п' => 'p',   'р' => 'r',
  
            'с' => 's',   'т' => 't',   'у' => 'u',
  
            'ф' => 'f',   'х' => 'x',   'ц' => 'c',
  
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
  
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'\'',
  
            'э' => 'e\'',   'ю' => 'yu',  'я' => 'ya',
          
  
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
  
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
  
            'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
  
            'И' => 'I',   'Й' => 'J',   'К' => 'K',
  
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
  
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
  
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
  
            'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
  
            'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
  
            'Ь' => '\'',  'Ы' => 'Y\'',   'Ъ' => '\'\'',
  
            'Э' => 'E\'',   'Ю' => 'YU',  'Я' => 'YA',
  
        );
        if ($type == 'front') {
            $out = strtr($text, $translit);
        }
        if ($type == 'back') {
            $out = strtr($text, array_flip($translit));
        }
       return $out;
    }

    public function region_table($name)
    {

        $old = Region::find()->where(['name' => $name])->limit(1)->one();
        if ($old == NULL) {
            $new = new Region();
            $new->name = $name;
            $new->save();
            $out = $new->id;
        }
        else{
            $out = $old->id;
        }
        return $out;
    }
    public function district_table($name, $id_region)
    {   

        $old = District::find()->where(['name' => $name, 'region_id' => $id_region])->limit(1)->one();
        if ($old == NULL) {
            $new = new District();
            $new->name = $name;
            $new->region_id = $id_region;
            $new->save();
        }
        return;
    }

    public function deleteComma($str)
    {
        return str_replace(',', '', $str);
    }

    public function strToArray($str)
    {
        $out = [];
        $arr = explode(' ', $str);
        if ($arr != NULL) {
            foreach ($arr as $item) {
                if (trim($item) != NULL) {
                    $out[] = trim($item);
                }
                
            }
        }
        else{
            $out[] = $str;
        }
        return $out;
    }

}
