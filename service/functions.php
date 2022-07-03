<?php
    function getAge($birthDate)
    { 
        $personAge = new DateTime($birthDate);
        $dateNow = new DateTime();
        return $personAge->diff($dateNow)->y." ans";
    }