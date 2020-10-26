<?php
/**
 * Created by PhpStorm.
 * User: yasird
 * Date: 13.03.2018
 * Time: 19:48
 */

namespace App\Helpers;


use App\Genre;
use App\Location;
use App\Price;

class Helpers
{



    static function genreList(){

        $genres = Genre::all();
        $arr = [];
        //$arr[0] = "Seçilmedi";
        foreach ($genres as $v){
            $arr[$v->id] = $v->genre_name;
        }
        return $arr;

        return [
            '1' => 'Aile',
            '2' => 'Aksiyon',
            '3' => 'Animasyon',
            '4' => 'Belgesel',
            '5' => 'Bilim Kurgu',
            '6' => 'Biyografi',
            '7' => 'Çizgi Film',
            '8' => 'Dans',
            '9' => 'Dram',
            '10' => 'Fantastik',
            '11' => 'Gençlik',
            '12' => 'Gerilim',
            '13' => 'Gizem',
            '14' => 'Hint',
            '15' => 'Komedi',
            '16' => 'Korku',
            '17' => 'Macera',
            '18' => 'Müzikal',
            '19' => 'Polisiye',
            '20' => 'Romantik',
            '21' => 'Savaş',
            '22' => 'Spor',
            '23' => 'Suç',
            '24' => 'Tarih',
        ];
    }



    static function priceList(){
        $prices = Price::all();
        $arr = [];
        foreach ($prices as $v){
            $arr[$v->price_value] = $v->price_name;
        }
        return $arr;
        return [
            '10' => 'İndirimli',
            '20' => 'Öğrenci',
            '30' => 'Tam',
        ];
    }

    static function cityList(){

        $locations = Location::all()->sortBy("location_name");
        $arr = [];
        //$arr[0] = "Seçilmedi";
        foreach ($locations as $v){
            $arr[$v->id] = $v->location_name;
        }
        return $arr;

        return [
            '1'=>'Adana',
            '2'=>'Adıyaman',
            '3'=>'Afyonkarahisar',
            '4'=>'Ağrı',
            '5'=>'Amasya',
            '6'=>'Ankara',
            '7'=>'Antalya',
            '8'=>'Artvin',
            '9'=>'Aydın',
            '10'=>'Balıkesir',
            '11'=>'Bilecik',
            '12'=>'Bingöl',
            '13'=>'Bitlis',
            '14'=>'Bolu',
            '15'=>'Burdur',
            '16'=>'Bursa',
            '17'=>'Çanakkale',
            '18'=>'Çankırı',
            '19'=>'Çorum',
            '20'=>'Denizli',
            '21'=>'Diyarbakır',
            '22'=>'Edirne',
            '23'=>'Elazığ',
            '24'=>'Erzincan',
            '25'=>'Erzurum',
            '26'=>'Eskişehir',
            '27'=>'Gaziantep',
            '28'=>'Giresun',
            '29'=>'Gümüşhane',
            '30'=>'Hakkâri',
            '31'=>'Hatay',
            '32'=>'Isparta',
            '33'=>'Mersin',
            '34'=>'İstanbul',
            '35'=>'İzmir',
            '36'=>'Kars',
            '37'=>'Kastamonu',
            '38'=>'Kayseri',
            '39'=>'Kırklareli',
            '40'=>'Kırşehir',
            '41'=>'Kocaeli',
            '42'=>'Konya',
            '43'=>'Kütahya',
            '44'=>'Malatya',
            '45'=>'Manisa',
            '46'=>'Kahramanmaraş',
            '47'=>'Mardin',
            '48'=>'Muğla',
            '49'=>'Muş',
            '50'=>'Nevşehir',
            '51'=>'Niğde',
            '52'=>'Ordu',
            '53'=>'Rize',
            '54'=>'Sakarya',
            '55'=>'Samsun',
            '56'=>'Siirt',
            '57'=>'Sinop',
            '58'=>'Sivas',
            '59'=>'Tekirdağ',
            '60'=>'Tokat',
            '61'=>'Trabzon',
            '62'=>'Tunceli',
            '63'=>'Şanlıurfa',
            '64'=>'Uşak',
            '65'=>'Van',
            '66'=>'Yozgat',
            '67'=>'Zonguldak',
            '68'=>'Aksaray',
            '69'=>'Bayburt',
            '70'=>'Karaman',
            '71'=>'Kırıkkale',
            '72'=>'Batman',
            '73'=>'Şırnak',
            '74'=>'Bartın',
            '75'=>'Ardahan',
            '76'=>'Iğdır',
            '77'=>'Yalova',
            '78'=>'Karabük',
            '79'=>'Kilis',
            '80'=>'Osmaniye',
            '81'=>'Düzce'
        ];
    }
}