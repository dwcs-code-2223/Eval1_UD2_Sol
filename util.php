<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
/* Orden 1 */

function existeUser(string $user, array $usuarios): bool {   
    return array_key_exists($user, $usuarios);
}

/* Orden 2 */

function esPwdCorrecta(string $user, string $pwd, array $usuarios): bool {   
    return $usuarios[$user]["pwd"] === $pwd;
}
/* Orden 3 */
function isEqual(string $pwd1, string $pwd2){
    return $pwd1===$pwd2;
}

/* Orden 4 */

function isValidLength(string $newPwd): bool {
    return strlen($newPwd) >= MIN_LENGH;
}

/* Orden 5 */

function fueUsada(string $user, string $newPwd, array $usuarios): bool {
  
    return in_array($newPwd, $usuarios[$user]);
}

/* Orden 6 */

function contieneMayuscula(string $newPwd): bool {
    return (strtolower($newPwd) != $newPwd);
}

/* Orden 7 y 8 */

function contieneElementosArray(string $newPwd, array $elemArray): bool {
//convierte string $newPwd en array 
    //comprueba si hay intersección entre sus elementos
    $interseccion = array_intersect(str_split($newPwd), $elemArray);
    return count($interseccion) > 0;
}



