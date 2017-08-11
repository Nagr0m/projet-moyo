<?php

namespace App\Http\Controllers\Teacher;

use Image;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;

class PostController extends Controller
{   
    use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::all();

        return view('teacher.posts_index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.posts_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'title'     => 'required|string',
            'content'   => 'required|string',
            'abstract'  => 'string|nullable',
            'published' => 'required',
            'thumbnail' => 'image|max:'.env('MAX_UPLOAD', 2000).'|nullable'
        ], [
            'required' => 'Ce champ est obligatoire',
            'image'    => 'Le fichier n\'est pas une image valide',
            'max'      => 'L\'image est trop grande (max: 2mo)'
        ]);

        # Traitement de l'image
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid())
        {   
            $Image = Image::make($request->thumbnail)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); # Respecte le ratio
                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
            });
            
            $imgName = str_random(12) . '.' . $request->thumbnail->extension();
            $imgPath = public_path('img/posts/') . $imgName;
            $imgURL  = '/img/posts/' . $imgName;
            
            $Image->save($imgPath, 100);
        }
        # Enregistrement de l'article
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'url_thumbnail' => isset($imgURL) ? $imgURL : null,
            'abstract' => isset($request->abstract) ? $request->abstract : '',
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('posts.index')->with('message', 'L\'article a bien été créé');
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
}
