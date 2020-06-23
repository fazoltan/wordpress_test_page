<?php
/*
Plugin Name: DB tester plugin
Plugin URI: https://fesk.com/
Description: Plugin for test wordpress native db engine.
Version: 0.0.1
Author: Fábián Zoltán
Author URI: https://fesk.com/
License: MIT
Text Domain: dbtester
*/

//Plugin indítása
function load_db_tester_plugin(){
    add_menu_page( 'DB test page', //olda címe html oldal title tagjában lesz benne
        'db tester', //ez fog megjelenni az oldal menűben
        'edit_users', //ki láthatja a menűpontot?, a 'read'-et minden felhasználó láthatja, az 'edit_users'-ert csak super adminisztrátor...
        'db_tester', //A menű elérési útja felül az url-ben
        'init_db_tester_page', //függvény neve, amely elindul, ha rákattintunk a nevére, ez fogjla legenerálni az aloldalunk tartalmát...
        );
}

//Az akció, aminek a hatására az indító függvény lefut. tanár comment. 
//https://codex.wordpress.org/Plugin_API/Action_Reference/admin_menu
//Az admin_menu akciora fuzzuk fel a pluginunkat
add_action( 'admin_menu', 'load_db_tester_plugin' );

//A menüpont tartalmának generálsa.

function init_db_tester_page(){
    include 'db_page.php';
}

//Admin footer hook. 

//A feladata, hogy beállitsa az ajaxot.
function my_action_callback(){
    global $wpdb;

    $records = $wpdb->get_results("SELECT * FROM $wpdb->posts" );

    echo json_encode($records);

    //nagyon fontos hogy a lekérést zárjuk MINDIG LE!
    //különben a ws beletehet saját cuccot és ezért a lekérés nem lesz valid
    wp_die();
}

//Kliens oldalon az ajax acionk neve: my_action
//add_action('wp_ajax_my_action', 'my_action_callback'); //wp_ajax_+sajat_akcio_nev
add_action('wp_ajax_nopriv_my_action', 'my_action_callback'); //ezzel mindenki eltudja érni az akciot


//Amikor a fejlécet töltjük be az ajaxurl-t echozzuk ki
add_action('wp_head','pluginname_ajaxurl'); 

//Ajax url beállítása a js -nek.
function pluginname_ajaxurl(){
    ?>
    <script type="text/javascript"> 
        //ez egy globális változo. Elérhetjük akár: window.ajaxurl
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>'; 
    </script>

    <?php
}

/**
 * Kliens oldal ajax küldése
 * 
 * var req = new XMLHttpRequest; //új kérés létrehozása
 * 
 *  req.open('get', ajaxurl+'?action=my_action'); // beállítjuk a kérés módját és helyét
 * // az ajax az ajaxurl-re várja a kérést. Chrome consol: ajaxurl
 * 
 * req.onloadend = function ( ev ){console.log(JSON.parse(ev.target.response))} // egy eseménykezelőt akasztunk rá
 *
 * req.send() // az eseményt elküldjük a szervernek   
 */