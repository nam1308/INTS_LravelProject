<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        return view('admin.testimonial.index');
    }

}
