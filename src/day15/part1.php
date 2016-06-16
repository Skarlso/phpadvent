<?php

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$ingreedients = [];
$iCount = [1, 1, 1, 1];

foreach ($lines as $line) {
    list($name, $_, $capacity, $_, $durability, $_, $flavour, $_, $texture, $_, $calories) = explode(' ', $line);
    $ingreedients[trim($name, ":")] = ['capacity' => trim($capacity, ","), 'durability' => trim($durability, ","),
                         'flavour' => trim($flavour, ","), 'texture' => trim($texture, ","),
                         'calories' => trim($calories, ",")];
}

$bestScore = 0;
// Optimize this later.
for (;;) {

    $currentScore = 0;
    if (array_sum($iCount) > 100) {
        continue;
    }

    $cal = $iCount[0] * $ingreedients['Sprinkles']['capacity'] +
           $iCount[1] * $ingreedients['Butterscotch']['capacity'] +
           $iCount[2] * $ingreedients['Chocolate']['capacity'] +
           $iCount[3] * $ingreedients['Candy']['capacity'];

    $dur = $iCount[0] * $ingreedients['Sprinkles']['durability'] +
           $iCount[1] * $ingreedients['Butterscotch']['durability'] +
           $iCount[2] * $ingreedients['Chocolate']['durability'] +
           $iCount[3] * $ingreedients['Candy']['durability'];

    $fla = $iCount[0] * $ingreedients['Sprinkles']['flavour'] +
           $iCount[1] * $ingreedients['Butterscotch']['flavour'] +
           $iCount[2] * $ingreedients['Chocolate']['flavour'] +
           $iCount[3] * $ingreedients['Candy']['flavour'];

    $tex = $iCount[0] * $ingreedients['Sprinkles']['texture'] +
           $iCount[1] * $ingreedients['Butterscotch']['texture'] +
           $iCount[2] * $ingreedients['Chocolate']['texture'] +
           $iCount[3] * $ingreedients['Candy']['texture'];

    $currentScore = $cal * $dur * $fla * $tex;

    if ($currentScore >= $bestScore) {
        $bestScore = $currentScore;
    }

    increaseIngredientCount($iCount, count($iCount) - 1);
    if ($iCount[0] == 97) {
        break;
    }

    echo "Best score so far: {$bestScore}\n";
    // print_r($iCount);
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
