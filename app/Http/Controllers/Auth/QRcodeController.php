<?php

namespace App\Http\Controllers\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeController
{
    public static function generateCode(String $code)
    {

        return QrCode::size(200)->generate("http://cinematic.test/bilhetes/".$code);
    }
}
