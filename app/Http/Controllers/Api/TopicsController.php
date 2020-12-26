<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_word = $request->search_word ?? '';
        $query = Topic::query();
        if ($search_word) {
            $query->where(function ($query) use ($search_word) {
                $query->where('id', $search_word);
                $query->orWhere('title', 'like', "%{$search_word}%");
                $query->orWhere('content', 'like', "%{$search_word}%");
            });
        }
        $topics = $query->offset($this->getOffset())->limit($this->getLimit())->get();
        $meta = $request->all();
        $meta['offset'] += count($topics);
        return $this->success('', $topics, $meta);
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
     * 这里只写入 title这个字段，content字段是通过 评论 选择后写入的
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->title) {
            $titles = explode(';', $request->title);
        } else
        if ($request->titles) {
            $titles = explode("\n", $request->titles);
        }
        else {
            // 读文件
            $titles = file_get_contents($request->file('file'));
            $titles = explode("\r\n", $titles);
        }

        $error_titles = [];
        $success_titles = [];

        $arr = [];

        $last_insert_topic = [];

        foreach ($titles as $title) {

            $title_arr = explode('.', $title);

            array_push($arr, $title_arr);

            if (is_numeric($title_arr[0])) {

                $title = str_replace($title_arr[0] . '.', '', $title);
            }

            if (!$title) continue;

            $topic = Topic::query()->where('title', $title)->first();
            if (!$topic) {

                $last_insert_topic = Topic::query()->create([
                    'user_id' => 1,
                    'title' => $title
                ]);

                array_push($success_titles, $title);

            } else {

                array_push($error_titles, $title);

            }

        }

        $meta = ['success_titles' => $success_titles, 'error_titles' => $error_titles, 'arr' => $arr, 'last_insert_topic' => $last_insert_topic];
        return $this->success('', $titles, $meta);

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
        $topic = Topic::query()->find($id);
        return $this->success('', $topic);
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

}
