<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Requests\NewsRequest;
use App\Models\NewsContent;
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
        switch(auth()->user()->role) {
            case 'admin':
                $news = News::with('newsContents')->whereNull('deleted_at')->filter()->paginate(5);
                break;
            case 'user':
                $news = News::with('newsContents')->whereNull('deleted_at')->filter()->paginate(8);
                break;
            default:
                $news = News::with('newsContents')->whereNull('deleted_at')->filter()->paginate(5);
        }
        
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
        $news->load('newsContents'); // Eager load news content
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
        // dd($request->all());
        $data = $request->validated();
        DB::beginTransaction();

        try {
            $news = News::create([
                'user_id' => auth()->id(),
                'title' => $request->title
            ]);    // create news item

            $newsItems = $request->input('news', []);
            $userId = auth()->id();

            foreach ($newsItems as $index => $item) {
                $data = [
                    'news_id' => $news->id, // Assuming same title for all
                    'content' => $item['content'],
                ];

                if ($request->hasFile("news.$index.image")) {
                    $imageFile = $request->file("news.$index.image");
                    $data['image'] = (new FileService())->storeImage($imageFile, 'news');
                }
                NewsContent::create($data); // create news content

            }

            DB::commit();

            return response()->json([
                'success' => 'News Created Successfully',
                'redirectUrl' => route('news.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'An error occurred while processing your request.',
                'message' => $e->getMessage()
            ], 500);
        }






        // try {
        //     if ($request->hasFile('image')) {
        //         $imagePath = (new FileService())->storeImage($data['image'], 'news');
        //         $data['image'] = $imagePath;
        //     }

        //     $data['user_id'] = auth()->user()->id; // Assuming you want to set the user_id to the authenticated user
        //     News::create($data);
        //     DB::commit();
        //     return response()->json([
        //         'success'=>'News Created Successfully',
        //         'redirectUrl' => route('news.index')
        //     ]);
        // } catch(\Exception $e){
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'An error occurred while processing your request.');
        // }


    }


    /**
     * Display edit form for a specific news item.
     */
    public function edit(News $news)
    {
        $news->load('newsContents'); // Eager load news contents
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified news item.
     *
     * @param  \App\Http\Requests\NewsRequest
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponsecod
     */
    public function update(NewsRequest $request, News $news)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $news->update([
                'title' => $request->title
            ]);

            $newsItems = $request->input('news', []);
            $existingIds = [];


            foreach ($newsItems as $index => $item) {
                $newsContentId = $item['id'] ?? null;
                $data = [
                    'news_id' => $news->id,
                    'content' => $item['content'],
                ];

                // If image is uploaded
                if ($request->hasFile("news.$index.image")) {
                    $imageFile = $request->file("news.$index.image");

                    if ($newsContentId) {
                        $existingContent = $news->newsContents()->find($newsContentId);
                        if ($existingContent && $existingContent->image) {
                            (new FileService())->deleteImage($existingContent->image); // fix var name
                        }
                    }

                    $data['image'] = (new FileService())->storeImage($imageFile, 'news'); // store image and get path
                }
                if ($newsContentId) {
                    // Update existing content
                    $news->newsContents()->where('id', $newsContentId)->update($data);
                    $existingIds[] = $newsContentId;
                } else {
                    // Create new content for news
                    $new = $news->newsContents()->create($data);
                    $existingIds[] = $new->id;
                }
            }

            // Optionally: delete removed contents
            $news->newsContents()->whereNotIn('id', $existingIds)->each(function ($content) {
                if ($content->image) {
                    (new FileService())->deleteImage($content->image);
                }
                $content->delete();
            });

            DB::commit();

            return response()->json([
                'success' => 'News Updated Successfully',
                'redirectUrl' => route('news.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'An error occurred while updating the news.',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function destroy(News $news)
    {
        DB::beginTransaction();
        try {
            $news->delete();
            foreach ($news->newsContents as $content) {
                if ($content->image) {
                    (new FileService())->deleteImage($content->image); // delete image
                }
                $content->delete(); // delete news content
            }
            DB::commit();
            return response()->json(['success' => 'Deleted Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollback();
            return response()->json(['error' => "Unexpected Error Occured"]);
        }
    }
}
