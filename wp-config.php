<?php
/**
 * A WordPress fő konfigurációs állománya
 *
 * Ebben a fájlban a következő beállításokat lehet megtenni: MySQL beállítások
 * tábla előtagok, titkos kulcsok, a WordPress nyelve, és ABSPATH.
 * További információ a fájl lehetséges opcióiról angolul itt található:
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 *  A MySQL beállításokat a szolgáltatónktól kell kérni.
 *
 * Ebből a fájlból készül el a telepítési folyamat közben a wp-config.php
 * állomány. Nem kötelező a webes telepítés használata, elegendő átnevezni
 * "wp-config.php" névre, és kitölteni az értékeket.
 *
 * @package WordPress
 */

// ** MySQL beállítások - Ezeket a szolgálatótól lehet beszerezni ** //
/** Adatbázis neve */
define( 'DB_NAME', 'fesk' );

/** MySQL felhasználónév */
define( 'DB_USER', 'fesk' );

/** MySQL jelszó. */
define( 'DB_PASSWORD', 'zoli1983' );

/** MySQL  kiszolgáló neve */
define( 'DB_HOST', 'localhost' );

/** Az adatbázis karakter kódolása */
define( 'DB_CHARSET', 'utf8mb4' );

/** Az adatbázis egybevetése */
define('DB_COLLATE', '');

/**#@+
 * Bejelentkezést tikosító kulcsok
 *
 * Változtassuk meg a lenti konstansok értékét egy-egy tetszóleges mondatra.
 * Generálhatunk is ilyen kulcsokat a {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org titkos kulcs szolgáltatásával}
 * Ezeknek a kulcsoknak a módosításával bármikor kiléptethető az összes bejelentkezett felhasználó az oldalról.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'jDMyC,hSu.vFernb^RUWs6&1)aQlaV_;h7wfHFKrmJ/4.]1p8XQazp(f+e4c bTO' );
define( 'SECURE_AUTH_KEY', 'n/hGkDKZ? xxo]0OFp>/j#*ie;e3a[kOC#q<0_87@N}jH4m5?2{=gv65Q)r>5GW8' );
define( 'LOGGED_IN_KEY', '<%YgK4/3B$h}AAX3kgGFK*44;M>c)r9GP&FoM@S[g*n8%?Cc,X;>SrM1r>l?20o$' );
define( 'NONCE_KEY', 'q7kAo5r,I5Yqa*^`R]7Tm(O`QL?*l{l_<!zlbIi<g3vg,0=k!Qph55ezIe;Rs<sI' );
define( 'AUTH_SALT',        'RLN;K0TJj_189^Z/rVixHjO$n+M?gW^yMUs|<NQy[.^%iL+l$.lxO|D{eShUdL9X' );
define( 'SECURE_AUTH_SALT', 'Ls)rqr:bmnE^G<f!-3n[c}!p/8(F1^G$t-%<hQx<m0`)Fs+Y7Rw2|rx<fRuR8VdW' );
define( 'LOGGED_IN_SALT',   'bA-`)CUA@$V>*wF{wLs}?{F_B<Wvu<zVxoYt.VA&,WivOzjtWdsFfQ2msFZh}4>G' );
define( 'NONCE_SALT',       'J:!R>Hv@CZ1AX276E1mkMw41BS{>Sm@!X<=MD5g6Iu74Z=3|V& 2<G<-Uf.ibJJc' );

/**#@-*/

/**
 * WordPress-adatbázis tábla előtag.
 *
 * Több blogot is telepíthetünk egy adatbázisba, ha valamennyinek egyedi
 * előtagot adunk. Csak számokat, betűket és alulvonásokat adhatunk meg.
 */
$table_prefix = 'wp_';

/**
 * Fejlesztőknek: WordPress hibakereső mód.
 *
 * Engedélyezzük ezt a megjegyzések megjelenítéséhez a fejlesztés során.
 * Erősen ajánlott, hogy a bővítmény- és sablonfejlesztők használják a WP_DEBUG
 * konstansot.
 */
define('WP_DEBUG', false);

/* Ennyi volt, kellemes blogolást! */

/** A WordPress könyvtár abszolút elérési útja. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Betöltjük a WordPress változókat és szükséges fájlokat. */
require_once(ABSPATH . 'wp-settings.php');
