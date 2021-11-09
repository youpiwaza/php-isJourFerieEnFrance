<?php
// * Jours fériés
//  @author Maxime Chevasson
//  @param  $timestamp  Timestamp unix de la date à tester
//  @return
//          false       Date non fériée en France
//          string      Date fériée en France, renvoi le libéllé du jour férié
//  @use    
//          isJourFerieEnFrance( mktime(0, 0, 0, 12, 25, 2021 );
//
//          Tester pour Noêl 2021
//              echo '<h1>Tester pour Noêl 2021         > isJourFerieEnFrance(mktime(0, 0, 0, 12, 25, 2021))</h1><pre>'; var_dump($this->isJourFerieEnFrance(mktime(0, 0, 0, 12, 25, 2021)));   echo '</pre>'; echo '<hr>';
//          Tester pour le 2 janvier 2022
//              echo '<h1>Tester pour le 2 janvier 2022 > isJourFerieEnFrance(mktime(0, 0, 0, 1, 2, 2022))  </h1><pre>'; var_dump($this->isJourFerieEnFrance(mktime(0, 0, 0, 1, 2, 2022)));     echo '</pre>'; echo '<hr>';
//
//  @see    https://phpsources.net/code/php/date-heure/382_determiner-rapidement-si-un-jour-est-ferie-fetes-mobiles-incluses
function isJourFerieEnFrance($timestamp) {
    $dateATester = array(
        'jour'      => date("d", $timestamp)
        ,'mois'     => date("m", $timestamp)
        ,'annee'    => date("Y", $timestamp)
    );

    // * Dates fériées fixes
    if( $dateATester['jour'] == 1   && $dateATester['mois'] == 1    ) return "Jour de l'an"     ; // 1er janvier
    if( $dateATester['jour'] == 1   && $dateATester['mois'] == 5    ) return 'Fête du travail'  ; // 1er mai
    if( $dateATester['jour'] == 8   && $dateATester['mois'] == 5    ) return 'Armistice de 1945'; // 8 mai
    if( $dateATester['jour'] == 14  && $dateATester['mois'] == 7    ) return 'Fête nationale'   ; // 14 juillet
    if( $dateATester['jour'] == 15  && $dateATester['mois'] == 8    ) return 'Assomption'       ; // 15 août
    if( $dateATester['jour'] == 1   && $dateATester['mois'] == 11   ) return 'Toussaint'        ; // 1 novembre
    if( $dateATester['jour'] == 11  && $dateATester['mois'] == 11   ) return 'Armistice de 1918'; // 11 novembre
    if( $dateATester['jour'] == 25  && $dateATester['mois'] == 12   ) return 'Noël'             ; // 25 décembre

    // * Fêtes religieuses mobiles
    // @see     https://www.php.net/manual/fr/function.easter-date.php
    $timestampPaques = easter_date($dateATester['annee']);

    // Pâques
    $datePaques = array(
        'jour'  => date("d", $timestampPaques)
        ,'mois' => date("m", $timestampPaques)
    );

    if( $datePaques['jour'] == $dateATester['jour'] && $datePaques['mois'] == $dateATester['mois'] ) return 'Pâques';

    // Lundi de Pâques
    $timestampLundiPaques = mktime(
        date ("H", $timestampPaques)
        ,date("i", $timestampPaques)
        ,date("s", $timestampPaques)
        ,date("m", $timestampPaques)
        ,date("d", $timestampPaques) +1
        ,date("Y", $timestampPaques)
    );
    $dateLundiPaques = array(
        'jour'  => date("d", $timestampLundiPaques)
        ,'mois' => date("m", $timestampLundiPaques)
    );

    if( $dateLundiPaques['jour'] == $dateATester['jour'] && $dateLundiPaques['mois'] == $dateATester['mois'] ) return 'Lundi de Pâques';

    // Ascension
    $timestampAscension = mktime(
        date ("H", $timestampPaques)
        ,date("i", $timestampPaques)
        ,date("s", $timestampPaques)
        ,date("m", $timestampPaques)
        ,date("d", $timestampPaques) + 39
        ,date("Y", $timestampPaques)
    );

    $dateAscension = array(
        'jour'  => date("d", $timestampAscension)
        ,'mois' => date("m", $timestampAscension)
    );

    if( $dateAscension['jour'] == $dateATester['jour'] && $dateAscension['mois'] == $dateATester['mois'] ) return 'Ascension';

    // Pentecôte
    $timestampPentecote = mktime(
        date ("H", $timestampPaques)
        ,date("i", $timestampPaques)
        ,date("s", $timestampPaques)
        ,date("m", $timestampPaques)
        ,date("d", $timestampPaques) + 49
        ,date("Y", $timestampPaques)
    );

    $datePentecote = array(
        'jour'  => date("d", $timestampPentecote)
        ,'mois' => date("m", $timestampPentecote)
    );

    if( $datePentecote['jour'] == $dateATester['jour'] && $datePentecote['mois'] == $dateATester['mois'] ) return 'Pentecôte';

    // Lundi de Pentecôte
    $timestampLundiPentecote = mktime(
        date ("H", $timestampAscension)
        ,date("i", $timestampPaques)
        ,date("s", $timestampPaques)
        ,date("m", $timestampPaques)
        ,date("d", $timestampPaques) + 50
        ,date("Y", $timestampPaques)
    );
    $dateLundiPentecote = array(
        'jour'  => date("d", $timestampLundiPentecote)
        ,'mois' => date("m", $timestampLundiPentecote)
    );

    if( $dateLundiPentecote['jour'] == $dateATester['jour'] && $dateLundiPentecote['mois'] == $dateATester['mois'] ) return 'Lundi de Pentecôte';

    return false;
}
?>
