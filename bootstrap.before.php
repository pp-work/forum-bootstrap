<?php

function ValidateUsernameRegex() {
    /*
     * Allow numbers, and all unicode letters
     * Allow dot if it isn't the the last char
     * Length is in the closed interval [3,20]
     */
    return '(?:[\d\pL]|[\d\pL\.](?=[\d\pL])){3,20}';
}
