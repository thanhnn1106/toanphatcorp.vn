<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;
use Validator;
use DB;

class ContactsController extends Controller
{
    public function add(Request $request)
    {
        $status = config('site.contact_status.value');
        $data = array(
            'name'    => $request->get('contactName'),
            'email'   => $request->get('contactEmail'),
            'title'   => $request->get('contactTitle'),
            'message' => $request->get('contactMessage'),
            'status'  => $status['new']
        );
        DB::table('contacts')->insert($data);

        return view('front.contact.send_success');
    }
}
