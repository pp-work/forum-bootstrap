<?php

function ValidateUsernameRegex() {
    /*
     * Allow numbers, and all unicode letters
     * Allow dot if it isn't the the last char
     * Length is in the closed interval [3,20]
     */
    return '(?:[\d\w\pL]|[\d\w\pL\.](?=[\d\w\pL])){3,20}';
}
