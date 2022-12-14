<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
/* Orden 1 */

function existeUser(string $user): bool {
    global $usuarios;
    return array_key_exists($user, $usuarios);
}

/* Orden 2 */

function esPwdCorrecta(string $user, string $pwd): bool {
    global $usuarios;
    return $usuarios[$user]["pwd"] === $pwd;
}

/* Orden 4 */

function isValidLength(string $newPwd): bool {
    return strlen($newPwd) >= MIN_LENGH;
}

/* Orden 5 */

function fueUsada(string $user, string $newPwd): bool {
    global $usuarios;
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

// Valida que las 4 entradas sean válidas para la condiciones 1-3 y añade mensajes a $errors
function validateInput(string $user, string $pwd, string $newPwd1, string $newPwd2): bool {
    global $errors;
    $valido = false;
    if (validateInputUser($user) && validateInputUserPwd($user, $pwd)) {
        if (isset($newPwd1) && isset($newPwd2)) {
            if ($newPwd1 !== $newPwd2) {
                array_push($errors, PWD_MISMATCH);
            } else {
                $valido = true;
            }
        }
    }

    return $valido;
}
//Valida que el usuario exista y si no, añade mensaje a $errors
function validateInputUser(string $user): bool {
    global $errors;
    $valido = false;
    if (!existeUser($user)) {
        array_push($errors, USER_DOES_NOT_EXIST);        
    } else {
        $valido = true;
    }

    return $valido;
}
//Valida que la contraseña actual es la del usuario y si no, añade mensaje a $errors
function validateInputUserPwd($user, $pwd): bool {
    global $errors;
    $valido = false;
    if (!esPwdCorrecta($user, $pwd)) {
        array_push($errors, PWD_INCORRECT);
    } else {
        $valido = true;
    }
    return $valido;
}
//Valida que la nueva contraseña cumpla con las condiciones 4-8
function isValidNewPwd(string $user, string $newPwd1): bool {
    global $errors, $numeros, $simbolos, $simbolos_string;
    $isValid = false;
    if (!isValidLength($newPwd1)) {
        array_push($errors, MIN_LENGTH_ERROR);
    } elseif (fueUsada($user, $newPwd1)) {
        array_push($errors, PWD_USED);
    } elseif (!contieneMayuscula($newPwd1)) {
        array_push($errors, UPPER_CASE_NEEDED);
    } else if (!contieneElementosArray($newPwd1, $numeros)) {
        array_push($errors, NUMBER_NEEDED);
    } else if (!contieneElementosArray($newPwd1, $simbolos)) {
        array_push($errors, SYMBOL_NEEDED . $simbolos_string);
    } else {
        $isValid = true;
    }
    return $isValid;
}

function actualizarPwd(string $user, string $newPwd1) {
    global $usuarios;
    $usuarios[$user]["pwd-2"] = $usuarios[$user]["pwd-1"];
    $usuarios[$user]["pwd-1"] = $usuarios[$user]["pwd"];
    $usuarios[$user]["pwd"] = $newPwd1;
}
