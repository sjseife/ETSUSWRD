<?php
    function phoneFormat ($phoneNumber)
    {
        if (strlen($phoneNumber) > 0) {
            $tempPhoneNumber = $phoneNumber;
            $tempPhoneNumber = preg_replace("/[^0-9,x]/", "", $tempPhoneNumber);
            if (strlen($tempPhoneNumber) > 10) {
                $tempPhoneNumber = preg_replace("/^[1]/", "", $tempPhoneNumber);
            }
            $tempPhoneNumber = '(' . substr($tempPhoneNumber, 0, 3) . ') '
                . substr($tempPhoneNumber, 3, 3) . '-'
                . substr($tempPhoneNumber, 6, 4) . ' '
                . substr($tempPhoneNumber, 10, (strlen($tempPhoneNumber) - 10));
            return $tempPhoneNumber;
        } else {
            return "Not Provided";
        }
    }
?>