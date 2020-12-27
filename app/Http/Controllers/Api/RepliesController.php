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
        $topic_id = $request->topic_id ?? 0;
        $content = $request->content ?? '';
        if ($topic_id <= 0) return $this->fail('话题不存在');
        if (!$content) return $this->fail('回复内容不能为空');

        $reply = Reply::query()->create([
            'user_id' => 1,
            'topic_id' => $topic_id,
            'parent_id' => 0,
            'content' => $content,
            'is_best' => false,
        ]);
        return $this->success('', $reply);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reply = Reply::query()->with(['topic'])->find($id);
        $reply->increment('read_count', 1);
        return $this->success('', $reply);
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
        $reply->topic()->update(['content' => $reply->content]);
        return $this->success();
    }
}
