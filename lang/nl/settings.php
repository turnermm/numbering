<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Gerrit <klapinklapin@gmail.com>
 * @author Rene <wllywlnt@yahoo.com>
 */
$lang['nstart']                = 'Het getal waarmee je begint te tellen';
$lang['padding']               = 'Waarde om toe te voegen aan het getal, als het getal kleiner is dan het maximum aantal cijfers van de eindwaarde';
$lang['pad_length']            = 'Het minimum aantal cijfers in de getalstring. Dit beperkt niet de omvang van het getal zelf, welke groter kan worden dan de aangegeven omvang.';
$lang['set_date']              = 'Indien waar dan zal de datum worden afgedrukt met het getal';
$lang['datestyle']             = 'Dit stelt het datum formaat in voor strftime, dit kan bevatten de Dokuwiki opmaakspecificatie voor vet, schuin, enz. Standaard wordt schuin gebruikt.';
$lang['format']                = 'Dit is een string die wordt gebruikt om de retour waarde te vormen, %d vertegenwoordigd de datum en %n de waarde en %i&lt;n&gt; afbeelding nummer n.  Evenals de datum stijl kan ook hier een formatering worden toegepast. Bijvoorbeeld: <b>** Date: %d Number: %n **</b>\';
';
$lang['imgs']                  = 'Komma gescheiden lijst van afbeeldingen in data/media, e.g <b>:image.png,:wiki:other_image.png, ...</b>Deze worden ingevoegd in de formatstring in de volgorde waarin zij worden getoond op de posities %i1. . . %i&lt;n&gt;';
$lang['use_imgs']              = 'Indien ingesteld op waar, dan zal de plugin trachten afbeeldingen in te voegen in de formatstring';
$lang['bureaucracy']           = 'Voor gebruik met de bureaucracy plugin. Kommagescheiden lijst van numerieke velden die een unieke opvolgende nummers nodig hebben. Zie <a href="https://forum.dokuwiki.org/post/68370">forum</a>.';
$lang['multi_db']              = 'Gebruik individuele tellers voor elke aparte bureaucracy getal-veld gespecificeerd in de <code>bureaucracy</code> optie.';
