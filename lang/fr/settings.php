<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * 
 * @author Schplurtz le Déboulonné <schplurtz@laposte.net>
 */
$lang['nstart']                = 'Commencer la numérotation avec ce nombre';
$lang['padding']               = 'Caractère de bourrage, si le nombre a moins de chiffres que le minimum désiré.';
$lang['pad_length']            = 'Nombre minimal de chiffres pour l\'affichage. Ceci ne limite pas le nombre lui même qui peut dépasser cette largeur d\'affichage.';
$lang['set_date']              = 'Afficher la date avec le nombre ?';
$lang['datestyle']             = 'Format de la date pour strftime. Le format peut inclure des spécificateurs de format comme gras, italique etc... Le défaut utilise l\'italique.';
$lang['format']                = 'Chaîne de format de la valeur affichée. %d représente la date, %n le nombre,  et %i&lt;n&gt; la nième image(voir réglage de la liste des images). Tout comme le style de date, cette chaîne peut contenir des indications de formatage, par exemple  <b>** Date: %d Numéro: %n **</b>';
$lang['imgs']                  = 'liste à virgule des images situées dans data/media. par ex <b>:image.png,:wiki:autre_image.png, . . .</b>. la position de ces image dans la liste, correspond au rang indiqué dans la chaîne de format <b>%i&lt;n&gt;</b>.';
$lang['use_imgs']              = 'Si vrai, l\'extension tentera d\'insérer des images dans la chaîne de format.';
