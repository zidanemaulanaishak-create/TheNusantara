<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Pulau;
use App\Models\Tentang;

class PageController extends Controller
{
    public function landing()
    {
        $tentang = Tentang::first()?->toArray();
        $pulauResult = Pulau::orderBy('id')->get();
        $faqData = Faq::orderBy('id')->get()->toArray();

        return view('pages.landing', compact('tentang', 'pulauResult', 'faqData'));
    }
}
