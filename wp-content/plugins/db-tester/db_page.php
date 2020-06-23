<?php
    //Ha nem létezik az init_db_tester_page akkor exittel száljon ki
    /**Műkódése: ez az init_db_tester_page az index.php-ban van definiálva.
     * Ha valaki nem ezen keresztűl jött be az oldalra, akkor ez nem létezik,
     * így automatikus kidobja a blugin a bejövőt.
     * 
     * Csak akkor fut, hadefiniálca van az init függvény
     */
    if (!function_exists('init_db_tester_page') ){
            exit('No access...');
    }
?>

<div>
    &nbsp;
</div>

<?php

//ha van olyan változonk a postban hogy get_request, akkor tudjuk, hogy ezt a gombot nyomtuk meg.
if (isset($_POST['get_request'])){
    global $wpdb; //Használjuk a wp adatbázis motorját:
    $table = $wpdb->prefix.'options';

    //var_dump($_POST); //kiiírjuk kidámpoljuk a postnak a tartlamát
    
    //A get_results mindig tömböt fog visszaadni
    //$site_url = $wpdb -> get_results("SELECT option_value FROM $table WHERE option_name='siteurl'");

    //$site_url = $wpdb -> get_col("SELECT option_value FROM $table ");

    $site_url = $wpdb -> get_results("SELECT option_value FROM $table WHERE option_name LIKE '%site%'");

  
    /*// a get_varral az adatbázisból egy sort kiolvassunk:
    $site_url = $wpdb -> get_var("SELECT option_value FROM $table WHERE option_name='siteurl'");*/

    /*
    //Ez nagyon lassu verzió mert az egész táblát lekéri
    $site_url = $wpdb -> get_var("SELECT * FROM wp_options", 
        2, //oszlop offset
        0); //sor offset
    */

    

    /*echo '<pre>';
         var_dump($site_url);
    echo '</pre>';*/

    //ez a var_dump-nál szebb eredményt ad
    echo '<pre>';
        print_r($site_url);
    echo '</pre>';

}

// Wpd insert.

if (isset($_POST['insert_request'])){
    global $wpdb; 

    //Tábla a beszúráshoz.

    $table = $wbdb->prefix.'wp_products';

    //Adatok a beszúráshoz.

    $data = [
        'name' => 'borotva',
        'price' => 2999
    ];
    
    //Formátumok meghatározása
    //Ez nem kötelező, de az sql injection miatt nagyobb biztonságot ad.
    $formats = ['%s','%d'];

    //Adtok beszúrása.

    $wpdb->insert($table,$data,$formats);

    //Az utjára beszúrt adat insert id-nek a lekérdezése

    echo "A record $wpdb->insert_id id-vel beszúrása került az adatbázisba";

}

// Wpd update.

if (isset($_POST['update_request'])){
    global $wpdb; 

    //Tábla a beszúráshoz.

    $table = $wbdb->prefix.'wp_products';

    //Adatok a beszúráshoz.

    $data = [
        'name' => 'tükör',
        'price' => 9999
    ];

    //Feltétel.

    //$where = ['id' => 1 ];

    //Feltétel nyersen :-)

    //$where = ["name LIKE '%borotva%'"];
    $where = [
        'id' => 1
    ];
    
    //Formátumok meghatározása
    //Ez nem kötelező, de az sql injection miatt nagyobb biztonságot ad.
    $formats = ['%s','%d'];

    //Adtok beszúrása.

    $row_num = $wpdb->update($table,$data,$where);

    //Nyugtázás

    //Az utolsó hiba kiírása
    if ($row_num === false){
        echo $wpdb->last_error;
        echo '<br>last query:'.$wpdb->last_query;
    } else{
        //Ha nincs hiba, kiirjuk az eredényt
        echo "$row_num sor frissült.";
    };

    
}
?>

<div>
    <form method="post">
        <input type="submit" name="get_request" value="get kérés">
    </form>
</div>
<div>
    <form method="post">
        <input type="submit" name="insert_request" value="insert">
    </form>
</div>
<div>
    <form method="post">
        <input type="submit" name="update_request" value="update">
    </form>
</div>

