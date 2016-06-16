<?php

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$ingreedients = [];
$iCount = [1, 1, 1, 1];

foreach ($lines as $line) {
    list($name, $_, $capacity, $_, $durability, $_, $flavour, $_, $texture, $_, $calories) = explode(' ', $line);
    $ingreedients[trim($name, ":")] = ['capacity' => intval(trim($capacity, ",")), 'durability' => intval(trim($durability, ",")),
                         'flavour' => intval(trim($flavour, ",")), 'texture' => intval(trim($texture, ",")),
                         'calories' => intval(trim($calories, ","))];
}

$bestScore = 0;
// Optimize this later.
for (;;) {
    if ($iCount[0] == 97) {
        break;
    }

    $currentScore = 0;
    if (array_sum($iCount) != 100) {
        increaseIngredientCount($iCount, count($iCount) - 1);
        continue;
    }

    $cap = $iCount[0] * $ingreedients['Sprinkles']['capacity'] +
           $iCount[1] * $ingreedients['Butterscotch']['capacity'] +
           $iCount[2] * $ingreedients['Chocolate']['capacity'] +
           $iCount[3] * $ingreedients['Candy']['capacity'];

    $cap = (abs($cap) + $cap) / 2;

    $dur = $iCount[0] * $ingreedients['Sprinkles']['durability'] +
           $iCount[1] * $ingreedients['Butterscotch']['durability'] +
           $iCount[2] * $ingreedients['Chocolate']['durability'] +
           $iCount[3] * $ingreedients['Candy']['durability'];
    $dur = (abs($dur) + $dur) / 2;

    $fla = $iCount[0] * $ingreedients['Sprinkles']['flavour'] +
           $iCount[1] * $ingreedients['Butterscotch']['flavour'] +
           $iCount[2] * $ingreedients['Chocolate']['flavour'] +
           $iCount[3] * $ingreedients['Candy']['flavour'];
    $fla = (abs($fla) + $fla) / 2;

    $tex = $iCount[0] * $ingreedients['Sprinkles']['texture'] +
           $iCount[1] * $ingreedients['Butterscotch']['texture'] +
           $iCount[2] * $ingreedients['Chocolate']['texture'] +
           $iCount[3] * $ingreedients['Candy']['texture'];
    $tex = (abs($tex) + $tex) / 2;

    $currentScore = $cap * $dur * $fla * $tex;

    if ($currentScore >= $bestScore) {
        $bestScore = $currentScore;
    }

    increaseIngredientCount($iCount, count($iCount) - 1);
}

echo "Best score: {$bestScore}", "\n";


function increaseIngredientCount(&$iCount, $n) {
    if ($n == 0) {
        $iCount[$n]++;
        if ($iCount[$n] == 98) {
            $iCount[$n] = 1;
        }
        return;
    }

    $iCount[$n]++;
    if ($iCount[$n] == 98) {
        $iCount[$n] = 1;
        increaseIngredientCount($iCount, --$n);
    }
    return;
}
