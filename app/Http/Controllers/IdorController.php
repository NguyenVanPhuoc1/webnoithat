<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdorController extends Controller
{
    //
    private function generateRandomString($length = 3)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    private function encodeID($originalID)
    {
        $encodedID = base64_encode($originalID);
        $randomPart = $this->generateRandomString();
        $finalID = $encodedID . $randomPart;

        return $finalID;
    }

    private function decodeID($encodedID)
    {
        $cutPosition = strlen($encodedID) - 3;
        $originalID = substr($encodedID, 0, $cutPosition);

        if (is_numeric(base64_decode($originalID))) {
            $result = (int) base64_decode($originalID);
        } else {
            $result = -1;
        }

        return $result;
    }
}
