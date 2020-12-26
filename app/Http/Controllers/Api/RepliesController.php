<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function index(Request $request)
    {
        $topic_id = $request->topic_id ?? 0;
        if ($topic_id <= 0) return $this->fail('话题不存在');

        $topic = Topic::query()->with(['replies' => function($query) {
            $query->orderBy('id', 'DESC');
        }])->find($topic_id);

        return $this->success('', $topic);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 设置最佳评论
    public function setBest(Reply $reply)
    {
        Reply::query()->where('topic_id', $reply->topic_id)->update(['is_best' => false]);
        $reply->update(['is_best' => true]);
        return $this->success();
    }
}
