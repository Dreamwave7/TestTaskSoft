<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchGoogleRequest;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class GoogleSearchController extends Controller
{
    public function search(SearchGoogleRequest $request)
    {
        $login = env('LOGIN_GOOGLE_SEARCH');
        $password = env('PASSWORD_GOOGLE_SEARCH');
        $postData = [
            'keyword' => $request->search_word,
            'language_name' => $request->language,
            'location_name' => $request->location,
            'depth' => '50'
        ];


        $post = Http::withBasicAuth($login,$password)->post(
            'https://api.dataforseo.com/v3/serp/google/organic/live/regular',[$postData]);


        try {

        $result =$post->json()['tasks'][0]['result'][0]['items'] ?? false;

        if ($result)
        {
            $existInSearch = false;
            foreach ($result as $item)
            {
                if (str_contains($item['domain'], $request->name_site)){$existInSearch = $item;break;};
            }

            return back()
                ->with('success', 'Пошук успішно здійснено!')
                ->with('site',$request->name_site)
                ->with('result',$result)
                ->with('exist', $existInSearch);
        }
        else
        {
            return back()->with('fail','Нажаль нічого не знайдено');
        }
        }
        catch (\Exception $exception)
        {
            Log::warning($exception);
            return back()->with('fail','Нажаль сталась помилка');
        }



    }
}
