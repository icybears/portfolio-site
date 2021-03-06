<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\SocialLink;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('isPageOwner');
    }
    public function store($username, Request $request)
    {
        $validator = Validator::make($request->all(), SocialLink::$rules);
        
                if ($validator->fails()) {
                    return back()
                                ->withErrors($validator)
                                ->withInput()
                                ->with('source', 'addSocial');
                }
        
       $socialLink = new SocialLink([
                    'label' => request('label'),
                    'url' => request('url')
                    ]);
        
       auth()->user()->socialLinks()->save( $socialLink );

       return back()->with(['message' => 'Social link added.', 'class' => 'success']);
    }

    public function destroy($username, $linkId)
    {
       
        auth()->user()->socialLinks()->where('id', $linkId)->delete();

        return back()->with(['message' => 'Social link removed.', 'class' => 'success']);
    }
}
