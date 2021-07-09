<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;

class GithubController extends Controller
{
    public function search(Request $request) {
        $results = [];

        foreach($request->usernames as $username) {
            if (empty($username) || $username == null) {
                continue;
            }
            $key = "github.user:" . $username;

            $user = Redis::get($key);
            if ($user) {
                array_push($results, json_decode($user, true));
                continue;
            }

            $user = Http::get('https://api.github.com/users/' . $username);

            if (isset($user['login'])) {
                array_push($results, json_decode($user, true));
                Redis::set($key, $user, 'EX', 120);
            }
        }

        usort($results, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $results;
    }
}
