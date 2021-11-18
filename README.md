# PHP > Fonction "isJourFerieEnFrance()"

Fonction PHP afin de déterminer si un jour est férié en france, à partir d'un timestamp.

Renvoie soit `false` si le jour n'est pas férié, soit le libéllé du jour férié.

J'ai essayé de faire au mieux avec ce que j'ai glanné sur internet, en cas d'erreur n'hésitez pas à me faire signe 🐬

Basic helpers to determine if a day is a Holiday in France.

| Variable  / Fonction | Libellé | Utilisation |
|---|---|---|
| `isJourFerieEnFrance()` | Prend un `timestamp`, & renvoie soit `false` soit le libelle de la fête | `isJourFerieEnFrance( mktime(0, 0, 0, 12, 25, 2021 );` |

## Ressources / Le merci

Basé majoritairement sur le code de [Olravet](https://phpsources.net/code/php/date-heure/382_determiner-rapidement-si-un-jour-est-ferie-fetes-mobiles-incluses) à qui je dit un grand merci 💖

## Utilisation

```php
<?php
use App\Helpers\Holidays;
$holidaysFunctions = new Holidays();

// Nowel 🎅🏻
echo $holidaysFunctions->isJourFerieEnFrance( mktime(0, 0, 0, 12, 25, 2021 );

//  Tester pour Noël 2021, renvoie 'Noël'
echo '<h1>Tester pour Noêl 2021         > isJourFerieEnFrance(mktime(0, 0, 0, 12, 25, 2021))</h1><pre>'; var_dump($this->isJourFerieEnFrance(mktime(0, 0, 0, 12, 25, 2021)));   echo '</pre>'; echo '<hr>';
// Tester pour le 2 janvier 2022, renvoie false // Go bosser
echo '<h1>Tester pour le 2 janvier 2022 > isJourFerieEnFrance(mktime(0, 0, 0, 1, 2, 2022))  </h1><pre>'; var_dump($this->isJourFerieEnFrance(mktime(0, 0, 0, 1, 2, 2022)));     echo '</pre>'; echo '<hr>';
?>
```

## Dates fériées fixes

| Libellé | Date |
|---|---|
| Jour de l'an | Premier janvier |
| Fête du travail | Premier mai |
| Armistice de 1945 | 8 mai |
| Fête nationale | 14 juillet |
| Assomption | 15 août |
| Toussaint | Premier novembre |
| Armistice de 1918 | 11 novembre |
| Noël | 25 décembre |

## Fêtes religieuses mobiles

Timestamp de Pâques déterminé à l'aide de la fonction [easter_date](https://www.php.net/manual/fr/function.easter-date.php).

| Libellé | Date |
|---|---|
| Pâques | Jour & mois du timestamp |
| Lundi de Pâques | timestamp + 1 jour |
| Ascension | timestamp + 39 jours |
| Pentecôte | timestamp + 49 jours |
| Lundi de Pentecôte | timestamp + 50 jours |

## TODO

- 🍻🥨 Jours fériés alsace
- ♻️ Refacto: Passer dates jours fériés fixes en propriétés ~renvoyer un tableau & boucler dessus
- ♻️ Refacto: Passer dates jours fériés mobiles en méthode  ~renvoyer un tableau & boucler dessus

