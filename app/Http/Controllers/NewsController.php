<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $news = News::whereNull('deleted_at')->filter()->paginate(4);
        return view('news.index', compact('news'));
    }

    /**
     * Display a create news page.
     *
     *
     */
    public function create()
    {
        return view('news.create');
    }


    /**
     * Display the specified news item.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\View\View
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }



    /**
     * Store a newly created news.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $imagePath = (new FileService())->storeImage($data['image'], 'news');
                $data['image'] = $imagePath;
            }

            $data['user_id'] = auth()->user()->id; // Assuming you want to set the user_id to the authenticated user
            News::create($data);
            DB::commit();
            return response()->json([
                'success'=>'News Created Successfully',
                'redirectUrl' => route('news.admin-index')
            ]);
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }


    }


    /**
     * Display edit form for a specific news item.
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified news item.
     *
     * @param  \App\Http\Requests\NewsRequest
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                Storage::delete('public/'. $news->image); // Delete old image if exists
                $imagePath = (new FileService())->storeImage($data['image'], 'uploads');
                $data['image'] = $imagePath;
            }

            $news->update($data);
            DB::commit();
            return response()->json([
                'success'=>'News Updated Successfully',
                'redirectUrl' => route('news.admin-index')
            ]);
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the news.');
        }
    }


    public function destroy(News $news)
    {
        DB::beginTransaction();
        try{
            $news->delete();
            $image = (new FileService())->deleteImage($news->image);
            DB::commit();
            return response()->json(['success' => 'Deleted Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollback();
            return response()->json(['error' => "Unexpected Error Occured"]);
        }
    }


}
