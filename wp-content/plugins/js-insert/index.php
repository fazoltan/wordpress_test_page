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

    wp_enqueue_script(
        'b-handler',//a scipt egyedi nevének megadása
        plugins_url('js-insert/js/bootstrap.bundle.min.js'),//src, scipt hol található egyedileg
        ['jquery'],//array $deps : Ebben a tömbe megadhatjuk, hogy a js fájlunk elött mit töltsön be. pl.: jQuary.js
        'v4.5.0',//$ver a sriptünknek mi a verziója. Ezzel a böngésző kesselését tudjuk fejlesztés közben
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

    //css oldal hozzáadása
    wp_enqueue_style( 
            'page-style',//string $handle, sítuslap nevének a megadása 
            plugins_url('js-insert/css/page-css.css'),//string $src = '',az elérési út megadása 
            array(),//string[] $deps = array(), függőségek megadása 
            date('YmdHis')//string|bool|null $ver = false, verzió megadása
            //string $media = 'all' ) Melyik médiára legyen alkalmazva pl.: print. alap értelmezette all
    );

    wp_enqueue_style( 
            'b-style',//string $handle, sítuslap nevének a megadása 
            plugins_url('js-insert/css/bootstrap.min.css'),//string $src = '',az elérési út megadása 
            array(),//string[] $deps = array(), függőségek megadása 
            'v4.5.0'//string|bool|null $ver = false, verzió megadása
            //string $media = 'all' ) Melyik médiára legyen alkalmazva pl.: print. alap értelmezette all
    );

}

add_action( 'wp_enqueue_scripts', 'add_my_scripts' );




// Shortcode hozzáadása a wordpress rendszerhez

//három artibutumot ad vissza: 1) attributumok 2) tartalom 3) A shorthcode neve , return json_encode(func_get_args());
function add_subsribe( $atts, $content , $name){
    //html-el dolgozunk, ezért egy ob buffert inditunk, hogy ne kerüljenek ki a dolgok élesben
    ob_start(); //ami ezután van az a php el fogja rejteni és egy pufferben fogja tárolni
    ?>

    <div class="urgent <?php echo $atts['cssclass']; /* Így egyedi sosztájt is tudunk hozzadni*/?>"> 
        <div class="row justify-content-center">
            <div class="col-8">
                <h3><?php echo $content?></h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <form class="col-8" >
                <div class="form-group">
                <label for="exampleInputName2">Name</label>
                <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                </div>
                <button type="submit" class="btn btn-default">Send invitation</button>
            </form>
        </div>
        
    </div>
    <?php

    $content = ob_get_contents(); //a buffer tartalmat kiolvassuk
    ob_clean(); //a buffert kiüritjük

    return $content; //azért érdemes a visszatérési érétket használni, mert a megfelelő helyen fog mejlennni a tartalom
    
}

add_shortcode('subsribe','add_subsribe');

/*function add_subscibe_form($atts){
    return json_encode($atts);
}

add_shortcode('subscripbe-form','add_subscibe_form');//1param: a short code neve, 2param: a függvény neve ami lekezeli


function wpdocs_bartag_func( $atts ) {
    $atts = shortcode_atts( array(
        'foo' => 'no foo',
        'baz' => 'default baz'
    ), $atts, 'bartag' );
 
    return "foo = {$atts['foo']}";
}

add_shortcode( 'bartag', 'wpdocs_bartag_func' );
*/

/*function 'init_func'(){
    function wpdocs_bartag_func( $atts ) {
    $atts = shortcode_atts( array(
        'foo' => 'no foo',
        'baz' => 'default baz'
    ), $atts, 'bartag' );
 
    return "foo = {$atts['foo']}";
}

add_shortcode( 'bartag', 'wpdocs_bartag_func' );
}
add_action('init','init_func');*/

