<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Comment\CommentRequest;
use App\Http\Requests\V1\MultiDeleteComment\MultiDeleteCommentRequest;
use App\Http\Resources\Api\V1\Comment\CommentCollection;
use App\Http\Resources\Api\V1\Comment\Comment as CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->hasRole('owner') ) {
            $comments = Comment::where('status', false)->latest()->paginate(10);
            return new CommentCollection($comments);
        }
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
    public function store(CommentRequest $request)
    {
        if( auth()->user()->hasRole(['owner', 'user']) ) {
            auth()->user()->comments()->create( $request->all() );

            return response([
                'date' => 'نظر شما با موفقیت ثبت گردید',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        if( auth()->user()->hasRole('owner') ) {
            return new CommentResource($comment);
        }
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
    public function destroy(Comment $comment)
    {
        if( auth()->user()->hasRole('owner') ) {
            $comment->delete();

            return response([
                'data' => 'نظر شما با موفقیت حذف شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isShow(Comment $comment) 
    {
        if( auth()->user()->hasRole('owner') ) {
            $comment->update([
                'is_show' => true
            ]);
            return response([
                'data' => 'تغییرات مورد نظر انجام شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commentStatus(Comment $comment) 
    {
        if( auth()->user()->hasRole('owner') ) {
            $comment->update([
                'status' => true
            ]);
            return response([
                'data' => 'تغییرات مورد نظر انجام شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDelete(MultiDeleteCommentRequest $request)
    {
        if( auth()->user()->hasRole('owner') ) {
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                DB::table('products')->where('id', $id)->delete();
            }

            return response([
                'data' => 'نظرات با موفقیت حذف شدند',
                'status' => 'success'
            ]);
        }
    }
}
