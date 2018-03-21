<?php

namespace Test\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Test\Models\Test;
use Test\Requests\TestRequest;

class SocketController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Test::socket.index");
    }

    /**
     * Save message to storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $redis = Redis::connection();
        $redis->publish('message', $request->input('message'));

        return response()->json(true);
    }
}
