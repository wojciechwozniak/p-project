<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('News.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->toArray();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return redirect('/news/create')
                ->withErrors($validator)
                ->withInput()
                ->with('status', ['error', 'Something went wrong!']);
        } else {
            $news = new News();
            $news->name = $data['name'];
            $news->description = $data['description'];
            $news->is_active = $data['is_active'];
            $news->author_id = Auth::user()->id;
            $news->save();
            return redirect('/home')->with('status', ['success', 'News Added!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        if ($news) {
            $author = User::where('id', $news->author_id)->get(['first_name', 'last_name'])->toArray();
            $news->author = implode(' ', $author[0]);
            return view('news.show', ['news' => $news]);
        } else {
            return redirect()->route('home')->with('status', ['error', 'Something went wrong!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        if ($news) {
            return view('news.edit', ['news' => $news]);

        } else {
            return redirect()->route('news.show', ['id' => $id])->with('status', ['error', 'Something went wrong!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $data = $request->toArray();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('news/edit', ['id' => $id])->with('status', ['error', 'Something went wrong!']);
        } else {
            $news->name = $data['name'];
            $news->description = $data['description'];
            $news->is_active = (isset($data['active'])) ? $data['active'] : Config::get('CONSTANS.STATE.INACTIVE');
            if ($news->save()) {
                return redirect()->route('news.show', ['id' => $id])->with('status', ['success', 'News updated!']);
            } else {
                return redirect()->route('news.edit', ['id' => $id])->with('status', ['error', 'Something went wrong!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if($news->delete()){
            return redirect()->route('home')->with('status',['success','News deleted!']);
        }
        else{
            return redirect()->route('home')->with('status', ['error', 'Something went wrong!']);
        }
    }

}
