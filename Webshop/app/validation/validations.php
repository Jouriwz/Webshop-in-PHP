<?php

$errors = [];

$validations = [
    'required',
    'number',
    'email',
    'name',
    'min',
    'max',
    'confirmed',
    'postcode',
];


foreach($variables as $key => $checks) {

    foreach($checks as $check) {

        $checkExploded = explode(':', $check);

        if(count($checkExploded) > 1) {
            // wel een :
            $checkFunction = 'is'.ucfirst($checkExploded[0]);
            if($error = $checkFunction($_POST[$key], $checkExploded[1], $key, $checks)) {

                if(array_key_exists($key, $errors)) {
                    array_push($errors[$key], $error);
                }
                else {
                    $errors[$key] = [$error];
                }
            }

        }
        else {
            // geen :
            $checkFunction = 'is'.ucfirst($check);

            if($error = $checkFunction($_POST[$key], $key, $checks)) {

                if(array_key_exists($key, $errors)) {
                    array_push($errors[$key], $error);
                }
                else {
                    $errors[$key] = [$error];
                }
            }
        }
    }
}


function isRequired($value, $key, $checks)
{
    if(! $value) {
        return 'U heeft geen waarde ingevuld';
    }
}

function isNumber($value, $key, $checks)
{
    if($value && ! is_numeric($value)) {
        return 'U heeft geen numerieke waarde ingevuld';
    }
}

function isPostcode($value, $key, $checks)
{
    if($value && ! preg_match('/^[1-9][0-9]{3}[\s]?[A-Za-z]{2}$/i', $value)) {
        return 'U heeft geen correcte postcode ingevuld';
    }
}

function isEmail($value, $key, $checks)
{
    if($value && ! preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i', $value)) {
        return 'U heeft geen geldig e-mail adres ingevuld';
    }
}

function isName($value, $key, $checks)
{
    if($value && ! preg_match('/^[\p{L}\s\'.-]+$/', $value)) {
        return 'U heeft geen geldige waarde ingevuld';
    }
}

function isConfirmed($value, $key, $checks)
{
    if($value && $_POST[$key] != $_POST[$key.'_confirmed']) {
        return 'Het confirmatie veld heeft niet dezelfde waarde';
    }
}

function isMin($value, $amount, $key, $checks)
{
    if($value && strlen($value) < $amount) {
        return 'U heeft niet voldoende tekens ingevoerd. Minimaal '.$amount;
    }
}

function isMax($value, $amount, $key, $checks)
{
    if($value && strlen($value) > $amount) {
        return 'U heeft teveel tekens ingevoerd. Maximaal '.$amount;
    }
}
