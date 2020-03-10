<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;
use Illuminate\Support\Facades\Auth;

class InitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //言語
        $lang = $request->session()->get('lang');
        if(empty($lang)){
            $lang = "ja";
        }
        
        if(!strcmp($lang, "ja")){
            $labelFile = file_get_contents( asset('/assets/file/languageJP.json'));
        }else{
            $labelFile = file_get_contents( asset('/assets/file/languageKO.json'));
        }

        $label = json_decode($labelFile);
        
        //user情報
        $user = Auth::user();
        
        $data = [
            ['lang'=>$lang]
            ,['label'=>$label]
            ,['user'=>$user]
        ];  

        $request->merge(['data'=>$data]);
        return $next($request);
    }
}
