<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class FooterItemsController extends Controller
{
    public function contact_us() {
        $item = ContactUs::where('id', 1)->first();

        return view('user.footerItems.contactUs', compact('item'));
    }
}
