<?php
/*
Plugin Name: Js inserter
Plugin URI: https://fesk.com/
Description: Plugin help you for insert js files.
Version: 0.0.1
Author: Fábián Zoltán
Author URI: https://fesk.com/
License: MIT
Text Domain: jsinsert
*/

//Js fájlok beszúrása a fontend oldalra.

function add_my_scripts(){

    //Az ajax handler script beszúrása az oldal láblécébe.
    wp_enqueue_script(
        'ajax-handler',//a scipt egyedi nevének megadása
        plugins_url('js-insert/js/ajax-handler.js'),//src, scipt hol található egyedileg
        ['jquery'],//array $deps : Ebben a tömbe megadhatjuk, hogy a js fájlunk elött mit töltsön be. pl.: jQuary.js
        date('YmdHis'),//$ver a sriptünknek mi a verziója. Ezzel a böngésző kesselését tudjuk fejlesztés közben
        //kijátszani. Így mindig a legujabb verzót fogja a böngészőnk betölteni. Fejlesztés után erre már nincs szüksége
        true//$in_footer : Hova tegye a sciptet? a fejlécbe(false) vagy a láblécbe(ture). Alapértelmezetten false.
    );

    //php az oldal betöltődésekor már tud inicializálni java változokat ezzel a függvénnyel:
    //Ezek csak az oldal betöltődéskor jönnek léter (inicializálás), amikor a wordperss összerakja az oldalt
    //, ha az oldal közben is szertnék változokat átadni, ahhoz már ajax kell
    //php változók hozzáadása a scipt-hez:
    wp_localize_script(
        'ajax-handler', //a scipt neve, amelyhez hozzáadjuk
        'ajaxOptions',//meg kell adni, mi legyen a változó neveh (objektum adunk)
        [//megadjuk a válozók érétékét egy tömben
            'ajaxurl'=> admin_url('admin-ajax.php'),
            'actionName' => 'it_ajax'
        ]);

}

add_action( 'wp_enqueue_scripts', 'add_my_scripts' );


function add_my_styles(){
    wp_enqueue_style( 
        'page-style',//string $handle, sítuslap nevének a megadása 
        plugins_url('js-insert/css/page-css.css'),//string $src = '',az elérési út megadása 
        array(),//string[] $deps = array(), függőségek megadása 
        date('YmdHis')//string|bool|null $ver = false, verzió megadása
        //string $media = 'all' ) Melyik médiára legyen alkalmazva pl.: print. alap értelmezette all
    );
}
add_action( 'wp_enqueue_scripts', 'add_my_styles' );


