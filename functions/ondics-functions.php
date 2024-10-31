<?php

/**
 * Menüeintrag Admin Panel
 * ========================
 * Funktion wird in die 'admin_menu' Aktion in ondics.php eingebunden, Aufruf mit add_action()
 *
 * @return ... null
 */
function ondicsMenu()
{
    add_menu_page(
        'Ondics', // Text im HTML-Seitentitel Tag '<title></title>'
        'Ondics', // Text im Admin-Menue
        0, // Benutzerrechte für diese Seite  'alle'
        'Ondics-Plugin', // Slug-Name URL-Seitentitel
        'ondicsPluginContent', // Funktion die den Seiteninhalt ausgibt
        'dashicons-admin-generic', // Icon für das Menue
        4 // Position im Admin-Menue
    );

    add_submenu_page(
        'Ondics-Plugin', // Slug-Name des uebergeordnete Menue
        'Ondics-Einstellungen', // Text im HTML-Seitentitel Tag '<title></title>'
        'Einstellungen', // Text im Admin-Menue
        10, // Benutzerrechte für diese Seite 'admin'
        'ondics', // Slug-Name URL-Seitentitel
        'ondicsOptionsPage' // Funktion die den Seiteninhalt ausgibt
    );

    add_submenu_page(
        'Ondics-Plugin',
        'Ondics-Support',
        'Support',
        0,
        'ondics-support',
        'ondicsPluginSupport'
    );

    add_submenu_page(
        'Ondics-Plugin',
        'Ondics-Dokumentation',
        'Wordpress-Hilfe',
        0,
        'ondics-dokumentation',
        'ondicsPluginDokumentation'
    );
    return null;
}

/**
 * Anzeige Menüeintrag Ondics
 * ===========================
 * Side-Effect: Ausgabe zu Informationen des Plugins und
 * der gebuchten Ondics-Leistungen als HTML (callback für wp-core function 'add_menu_page')
 *
 * @return ... null
 */
function ondicsPluginContent()
{
    ?>
    <div class="wrap">
        <h1>Ondics Wordpress Hosting</h1>
        <p> Wordpress Hosting bei Ondics: Damit Ihre Website einfach bedienbar und sicher bleibt.<p>
        <p>
        <?php
            echo '<img class="logo" src="' . plugins_url('bilder/ondics_coloriert.svg', dirname(__FILE__)) . '" > ';
        ?>
        </p>
        <p>
            Mit diesem Ondics Wordpress Plugin werden zusätzliche Leistungen im
            Wordpress-CMS aktiviert.<br> Falls Sie an weiteren Leistungen
            interessiert sind, sprechen Sie <a href="./admin.php?page=ondics-support">uns</a> an.
        </p>
        <h2>Ondics - Leistungsumfang</h2>
        <div style="width:20%;">
        <?php
            ondicsDashboardInfo();
        ?>
        </div>
    </div>
    <?php
    return null;
}

/**
 * Anzeige Ondics-Support
 * =======================
 * Side-Effect: Ausgabe von Ondics-Support als HTML (callback für wp-core function 'add_submenu_page')
 *
 * @return ... null
 */
function ondicsPluginSupport()
{
    $options = get_option('ondicsSettings');
    ?>
    <div class="wrap">
        <h1>Ondics Support-Kontakt</h1>
        <p>
            Wenn Sie Fragen haben oder Hilfestellung im Rahmen Ihres
            Support-Vertrages benötigen, stehen wir Ihnen gerne zur Verfügung.
        </p>
        <?php
        $options = get_option('ondicsSettings');
        if ($options && trim($options['ondicsRedmineUrl']) !="") {
            ?>
            <h2 class="support-system">Support-System</h2>
            <p>
                Bei Fragen empfehlen wir Ihnen,
                eine Anfrage über unser Support-System zu stellen.
            </p>
            <table>
            <th>Hierzu benutzten Sie bitte folgenden Link:</th>
            <tr>
                <td>
                    <a href="<?php echo $options['ondicsRedmineUrl'].'/issues'; ?>"target="_blank">
                        Übersicht bestehnde Support-Anfragen
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo $options['ondicsRedmineUrl'].'/issues/new'; ?>"target="_blank">
                        Neue Support-Anfragen stellen
                    </a>
                </td>
            </tr>
            </table>
            <?php
        }
        ?>

        <h2 class="support-telefon">Persönlicher Support-Kontakt</h2>
        <table width=15%>
        <tr><td class="phone">Telefon:</td><td>0711/310093100</td></tr>
        </table>

        </p>
    <?php
    return null;
}

/**
 * Anzeige Wordpress-Hilfe
 * ========================
 * Side-Effect: Ausgabe der Doku als HTML (callback für wp-core function 'add_submenu_page')
 *
 * @return ... null
 */
function ondicsPluginDokumentation()
{
    ?>
    <div class="wrap">
        <h1>Wordpress-Hilfe</h1>
        <p>
            In der Wordpress-Hilfe haben wir einige Links und Hinweise aufgelistet,<br>
            die für Wordpress-Gelegenheitsbenutzern sehr hilfreich sind.
        </p>
        <h2>Wordpress erste Schritte</h2>
        <p>Wenn Sie ab und zu eine Seite ändern müssen, helfen diese Links:</p>
        <ul>
            <li>
                <a href="https://wp-wizard.de/tutorial/wordpress-grundlagen/" target="_blank">
                    Grundlagen für Wordpress
                </a>
            </li>
            <li>
                <a href="https://www.wplo.de/text-hinzufuegen-bearbeiten-und-formatieren-mit-wordpress/" target="_blank">
                Text hinzufügen und bearbeiten
                </a>
            </li>
        </ul>
        <h2>Falls Sie HTML-Elemente benutzen wollen, empfehlen wir folgende Seiten:</h2>
        <ul>
            <li><a href="https://wiki.selfhtml.org/" target="_blank">SELFHTML</a></li>
            <li><a href="https://www.w3schools.com/" target="_blank">w3schools</a></li>
        </ul>
        <h2>Das Design Theme Divi</h2>
        <p>
            Mit DIVI werden Website gestaltet und verschiedene Inhaltselemente<br>
            in Form gebracht (Bilder, Youtube-Videos, Text, etc.).
        </p>
        <ul>
            <li>
                <a href="https://www.elegantthemes.com/documentation/divi/" target="_blank">
                    Elegant Themes: Hersteller von Divi
                </a>
            </li>
        </ul>
        <h2>SEO Grundlagen</h2>
        <p>
            Mit SEO optimieren Sie, wie Ihre Seite in der Google-Suchmaschine gefunden wird.<br>
            Unsere Empfehlung ist, dass mindestens eine orange Ampel erreicht wird bei einer<br>
            Seite mit Textinhalten.
            Die Einstellungen erfolgen auf der jeweiligen Seite unten im Abschnitt "...."<br>
        </p>
        <ul>
            <li>
                <a href="https://www.ranksider.de/talk/seo-grundlagen" target="_blank">
                    SEO Grundlagen
                </a>
            </li>
        </ul>
        <h2>Datenschutz nach DSGVO</h2>
        <p>Seit dem 25.5.2018 ist die DSGVO verbindlich. Weitere Hinweise hierzu unter:</p>
        <ul>
            <li>
                <a href="https://www.bitkom.org/Themen/Datenschutz-Sicherheit/Datenschutz/Inhaltsseite-3.html" target="_blank">
                Die wichtigsten Fragen und Antworten zur EU-Datenschutzgrundverordnung (DSGVO)
                </a>
            </li>
            <li>
                <a href="https://www.bfdi.bund.de/DE/Datenschutz/DatenschutzGVO/Reform/ReformEUDatenschutzrechtArtikel/ReformEUDatenschutzRecht.html" target="_balnk">
                    Die Reform des Europäischen Datenschutzrechts
                </a>
            </li>
             <li>
                <a href="https://dsgvo-gesetz.de/" target="_blank">
                    Europäische Datenschutz-Grundverordnung
                </a>
             </li>
        </ul>
        <?php
        return null;
}

/**
 * Fuegt ein Widget zum Dashboard hinzu
 * ======================================
 * Funktion wird in die 'wp_dashboard_setup' Aktion in ondics.php eingebunden
 *
 * @return ... null
 */
function ondicsDashboardWidgets()
{
    wp_add_dashboard_widget(
        'Ondics',
        'Ondics - Leistungsumfang',
        'ondicsDashboardInfo'
    );
    return null;
}

/**
 * Anzeige Ondics-Leistungen im Dashboard
 * =======================================
 * Side-Effect: Ausgabe der Ondics-Leistungen als HTML (callback für wp-core 'wp_add_dashboard_widget')
 *
 * @return ... null
 */
function ondicsDashboardInfo()
{
    $options = get_option('ondicsSettings');

    $ondicsFeatures = array(
        "WP-CMS Wartung Standard" => $options ? $options['ondicsCheckboxStandard'] : false,
        "WP-CMS Wartung Erweitert" => $options ? $options['ondicsCheckboxErweitert'] : false,
        "Tracking (Matomo / Piwik)" => $options ? $options['ondicsMatomoId'] : false,
        "Redmine Ticket Service" => $options ? $options['ondicsRedmineUrl'] : false
    );

    echo '<table width="100%">';
    echo '<tr><td><b>Gebuchte Leistungen</b></td>';
    echo '<td align=right><b>aktiv</b></td></tr>';

    foreach ($ondicsFeatures as $key => $value) {
        $dashIconWp = "dashicons-".($value ? "yes": "no-alt");
        echo "<tr><td>$key</td><td align='right'>".
             "<span class=\"dashicons $dashIconWp\"></span></td></tr>";
    }
    echo '</table>';
    return null;
}

/**
 * Options Page für Ondics settings
 * =================================
 * Funktion wird in die 'admin_init' Aktion in ondics.php eingebunden, Aufruf mit add_action()
 *
 * @return ... null
 */
function ondicsSettingsInit()
{

    register_setting('pluginPage', 'ondicsSettings');

    add_settings_section(
        'ondicsPluginPageSection', // Name der Sektion
        'Aktivierung gebuchter Leistungen', // Ueberschrift der Sektion
        'ondicsSettingsSectionCallback', // Callback der Funktion zur Ausgabe Inhlat
        'pluginPage' // Menue in der die Sektion ausgegeben wird
    );

    add_settings_field(
        'ondicsCheckboxStandard', // Slug-Name, um das Feld zu identifizieren
        'WP-CMS Wartung Standard', // Titel für das Optionsfeld
        'ondicsCheckboxStandardRender', // Callback für das Optionsfeld mit den gewünschten Formulareingaben
        'pluginPage', // Menue in der das Optionsfeld angezeigt wird
        'ondicsPluginPageSection' // Name der Sektion in der das Optionsfeld angezeigt wird
    );

    add_settings_field(
        'ondicsCheckboxErweitert',
        'WP-CMS Wartung Erweitert',
        'ondicsCheckboxErweitertRender',
        'pluginPage',
        'ondicsPluginPageSection'
    );

    add_settings_field(
        'ondicsMatomoId',
        'Matomo ID',
        'ondicsMatomoIdRender',
        'pluginPage',
        'ondicsPluginPageSection'
    );

    add_settings_field(
        'ondicsRedmineUrl',
        'Redmine URL',
        'ondicsRedmineUrlRender',
        'pluginPage',
        'ondicsPluginPageSection'
    );

    return null;
}

/* Sektion Ondics-Leistungen */

/**
 * Ausgabe Hinweistext zur Sektion Ondics-Leistungen im Submenue "Einstellungen"
 * =======================================================================
 * Side-Effect: Ausgabe als HTML (callback für wp-core 'add_settings_section')
 *
 * @return ... null
 */
function ondicsSettingsSectionCallback()
{
    echo __(
        'Hier wird das Plugin auf die von dem Kunden
            spezifizierten Leistungen eingestellt.'
    );
    return null;
}

/**
 * Anzeige Checkbocks WP-CMS Wartung Standard im Submenue "Einstellungen"
 * =======================================================================
 * Side-Effect: Ausgabe der Checkbox als HTML (callback für wp-core 'add_settings_field')
 *
 * @return ... null
 */
function ondicsCheckboxStandardRender()
{
    $options = get_option('ondicsSettings');
    ?>
    <input type='checkbox' name='ondicsSettings[ondicsCheckboxStandard]'
        <?php checked($options['ondicsCheckboxStandard'], 1); ?> value='1'>
    <?php
    return null;
}

/**
 * Anzeige Checkbocks WP-CMS Wartung Erweitert im Submenue "Einstellungen"
 * ========================================================================
 * Side-Effect: Ausgabe der Checkbox als HTML (callback für wp-core 'add_settings_field')
 *
 * @return ... null
 */
function ondicsCheckboxErweitertRender()
{
    $options = get_option('ondicsSettings');
    ?>
    <input type='checkbox' name='ondicsSettings[ondicsCheckboxErweitert]'
        <?php checked($options['ondicsCheckboxErweitert'], 1); ?> value='1'>
    <?php
    return null;
}

/**
 * Anzeige Eingabefeld Matomo ID im Submenue "Einstellungen"
 * ==========================================================
 * Side-Effect: Ausgabe des Eingabefelds als HTML (callback für wp-core 'add_settings_field')
 *
 * @return ... null
 */
function ondicsMatomoIdRender()
{
    $options = get_option('ondicsSettings');
    ?>
    <input type='text' maxlength='100' name='ondicsSettings[ondicsMatomoId]'
        value='<?php echo $options['ondicsMatomoId']; ?>'><br>
    <?php
    if ($options['ondicsMatomoId'] != "") { // Überprüft ob das Textfeld leer ist
        if (! preg_match('/^[0-9]+$/', $options['ondicsMatomoId'])) { // Überprüft die ID, ob nur Zahlen enthalten sind
            ?>
            <p class="eingabe">
                Die ID darf nur aus Zahlen bestehen!<br> <!-- Meldung bei falscher Eingabe -->
            </p>
            <br>
            <?php
        }
    }

    echo 'Um Matomo zu aktivieren muss eine ID eingetragen werden.<br>
          Anschließend kann folgender Shortcode [opt-out height="200px" width="100%"]<br>
          in einer passenden Seite(z.B Datenschutz) eingetragen werden.<br>
          Die Werte "width" und "height" müssen unter Umständen angepasst werden.';
    return null;
}

/**
 * Anzeige Redmine URL im Submenue "Einstellungen"
 * ================================================
 * Side-Effect: Ausgabe des Eingabefelds als HTML (callback für wp-core 'add_settings_field')
 *
 * @return ... null
 */
function ondicsRedmineUrlRender()
{
    $options = get_option('ondicsSettings');
    ?>
    <input type='text' maxlength='100' name='ondicsSettings[ondicsRedmineUrl]'
        value='<?php echo $options['ondicsRedmineUrl']; ?>'><br>
    <?php
    echo 'Falls der Kunde einen Redmine Zugang hat, hier die URL zu seinem Tracker eintragen.';
    return null;
}


/**
 * Anzeige Submenue "Einstellungen"
 * =====================================================================
 * Side-Effect: Ausgabe HTML (callback für wp-core 'add_submenu_page')
 *
 * @return ... null
 */
function ondicsOptionsPage()
{
    ?>
    <form action='options.php' method='post'>
        <h1>Einstellungen Ondics Leistungen</h1>
    <?php
    settings_fields('pluginPage');
    do_settings_sections('pluginPage');
    submit_button();
    ?>
    </form>
    <?php
    return null;
}

/**
 * Admin Style anpassen
 * =====================
 * Funktion wird in die 'admin_enqueue_scripts' Aktion in ondics.php eingebunden
 * Aufruf mit add_action()
 *
 * @return ... null
 */
function adminStyle()
{
    wp_enqueue_style('admin-styles', plugins_url('css/ondics.css', dirname(__FILE__)));
    return null;
}

/**
 * Shortcode Email-Obfuscation
 * ============================
 * Verstecke E-Mails von Spam Bots mit einem Shortcode
 *
 * @param array  $atts    ... Shortcode Attribut, wird nicht genuzt
 * @param string $content ... Shortcode Inhalt, muss eine Email-Adresse sein
 *
 * @return string Verschleierte Email-Adresse
 */
function ondicsEmailObfuscation($atts, $content = null)
{
    if (! is_email($content)) {
        return;
    }
    return antispambot($content); // Funktion antispambot() codiert Zeichenketten
}

/**
 * Shorcode Matomo Opt-Out iframe
 * ===============================
 * Gibt das iframe für die Funktion Matomo Opt-Out aus
 *
 * @param array $atts ... assoziatives Array mit Werten für 'Hoehe' und 'Breite' für das iframe
 *
 * @return iframe mit Text und Opt-Out Funktion
 */
function matomoOptOut($atts) // $atts Variable für das assoziative Array
{
    $options = get_option('ondicsSettings');
    $matomo_id = $options['ondicsMatomoId'];
    $werte = shortcode_atts(
        array(
        'height' => '200px', // Vorgabewert
        'width'  => '100%', // Vorgabewert
        ),
        $atts // Name des assoziativen Arrays in dem die Vorgabewerte gespeichtert werden
    );
    return '<iframe style="border: 0; height:'.$werte[height].'; width:'.$werte[width].';"
            src="https://analyse.ondics.de/index.php?module=CoreAdminHome&action=optOut&idsite='.$matomo_id.'&language=de"
            width="300" height="150">
            </iframe>';
}

/**
 * Matomo Tracking Code in header.php einbinden
 * =====================================================================
 * Side-Effect: Ausgabe javascript
 * (Funktion wird in 'wp-head' Aktion in ondics.php eingebunden, Aufruf mit add_action())
 *
 * @return ... null
 */
function ondicsMatomo()
{
    $options = get_option('ondicsSettings');
    $options['ondicsMatomoId'] = trim($options['ondicsMatomoId']);
    ?>
    <!-- Matomo -->
    <script type="text/javascript">
        var _paq = _paq || [];
        tracker methods like "setCustomDimension"
           should be called before "trackPageView" * /
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://analyse.ondics.de/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', <?php echo $options['ondicsMatomoId']; ?> ]);
            var d=document, g=d.createElement('script'),
                s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true;
            g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
    <?php
    return null;
}
