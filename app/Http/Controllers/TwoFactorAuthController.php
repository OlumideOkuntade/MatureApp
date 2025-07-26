<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class TwoFactorAuthController extends Controller
{
    public function show2faSetup(Request $request){
        $user = $request->user();
        $google2fa = new Google2FA();

        if (!$user->google2fa_secret) {
            $secret = $google2fa->generateSecretKey();
            $user->google2fa_secret = encrypt($secret);
            $user->save();
        } else {
            $secret = decrypt($user->google2fa_secret);
        }
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );
        // Generate QR image
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            )
        );
        $qrImage = base64_encode($writer->writeString($qrCodeUrl));

        return view('2fa_setup')->with('qrImage', $qrImage)->with('secret', $secret);
    }
   
    public function enable2fa(Request $request)
    {
        $user = $request->user();
        $google2fa = new Google2FA();
        $secret = decrypt($user->google2fa_secret);

        if ($google2fa->verifyKey($secret, $request->otp)) {
            $user->google2fa_enabled = true;
            $user->save();
            return redirect()->route('dashboard')->with('success', '2FA enabled successfully!');
        }
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    public function show2faVerify()
    {
        return view('2fa_verify');
    }

    public function verify2fa(Request $request)
    {
        $request->validate(['otp' => 'required']);
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired. Please login again.']);
        }

        $google2fa = new Google2FA();

        if ($google2fa->verifyKey(decrypt($user->google2fa_secret), $request->otp)) {
            // Clear session and log in user manually
            auth()->login($user);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid verification code.']);
    }
}
