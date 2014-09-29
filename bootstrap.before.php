<?php

function ValidateUsernameRegex() {
    /*
     * Allow numbers, word characters (a-zA-Z_), åäöÅÄÖ
     * Allow dot if it isn't the the last char.
     * Length is in the closed interval [3,20]
     */
    return '(?:[\d\wåäöÅÄÖ]|[\d\wåäöÅÄÖ\.](?=[\d\wåäöÅÄÖ])){3,20}';
}
