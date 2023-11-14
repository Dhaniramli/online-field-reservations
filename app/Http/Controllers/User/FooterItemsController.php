<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\HowTocancel;
use App\Models\HowToorder;
use App\Models\HowTopay;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class FooterItemsController extends Controller
{
    public function contact_us()
    {
        $item = ContactUs::where('id', 1)->first();

        return view('user.footerItems.contactUs', compact('item'));
    }

    public function privacy_policy()
    {
        $item = PrivacyPolicy::where('id', 1)->first();

        return view('user.footerItems.privacyPolicy', compact('item'));
    }

    public function cara_booking()
    {
        $item = HowToorder::where('id', 1)->first();

        return view('user.footerItems.howToorder', compact('item'));
    }

    public function pembayaran()
    {
        $item = HowTopay::where('id', 1)->first();

        return view('user.footerItems.howTopay', compact('item'));
    }

    public function pembatalan()
    {
        $item = HowTocancel::where('id', 1)->first();

        return view('user.footerItems.howTocancel', compact('item'));
    }
}
