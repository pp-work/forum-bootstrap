<?php

class MentionsFormatter {
    public function GetMentions($String) {
        $Mentions = array();
        // This one grabs mentions that start at the beginning of $String
        preg_match_all(
            '/(?:^|[\s,\.>])@('.ValidateUsernameRegex().')\b/i',
            $String,
            $Matches
        );
        if (count($Matches) > 1) {
            $Result = array_unique($Matches[1]);
            return $Result;
        }
        return array();
    }
    public function FormatMentions($Mixed) {
        if (!is_string($Mixed)) {
            return To($Mixed, 'Mentions');
        }
        // Handle @mentions.
        if(C('Garden.Format.Mentions')) {
            $Mixed = preg_replace(
                '/(^|[\s,\.>])@('.ValidateUsernameRegex().')\b/i',
                '\1'.Anchor('@\2', '/profile/\\2'),
                $Mixed
            );
        }
        // Handle #hashtag searches
        if(C('Garden.Format.Hashtags')) {
            $Mixed = preg_replace(
                '/(^|[\s,\.>])\#([\w\-]+)(?=[\s,\.!?]|$)/i',
                '\1'.Anchor('#\2', '/search?Search=%23\2&Mode=like').'\3',
                $Mixed
            );
        }
        // Handle "/me does x" action statements
        if(C('Garden.Format.MeActions')) {
            $Mixed = preg_replace(
                '/(^|[\n])(\/me)(\s[^(\n)]+)/i',
                '\1'.Wrap(Wrap('\2', 'span', array('class' => 'MeActionName')).'\3', 'span', array('class' => 'AuthorAction')),
                $Mixed
            );
        }
        return $Mixed;
    }
}
Gdn::FactoryInstall('MentionsFormatter', 'MentionsFormatter', NULL, Gdn::FactoryInstance);
