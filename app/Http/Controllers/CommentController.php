<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {   
        $this->commentService = $commentService;
    }

    public function index(Request $request)
    {
        return $this->commentService->index($request);
    }

    public function create(CommentRequest $request)
    {
        return $this->commentService->createComment($request->validated());
    }

    public function show(Comment $comment)
    {
        try {
            return response()->json(['data' => $comment, 'message' => 'Success!'], 200);
        } catch (NotFoundHttpException $e) {
            abort(400);
        }
    }

    public function edit(CommentUpdateRequest $request,Comment $comment)
    {
        return $this->commentService->editComment($request->validated(), $comment);
    }

    public function destroy(Comment $comment)
    {
        return $this->commentService->deleteComment($comment);
    }
}
