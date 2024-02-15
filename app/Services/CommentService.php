<?php

namespace App\Services;
use App\Contracts\Repositories\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentService
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {   
        $this->commentRepo = $commentRepo;
    }

    public function index(Request $request)
    {
        $query = User::query();

        $query->join('posts', 'users.id', '=', 'posts.user_id')
                ->join('comments', 'posts.id', '=' , 'comments.post_id')
                ->where('users.id', auth()->user()->id);

        $data = $this->getCommentBasedTime($request, $query);

        return response()->json(['data' => $data], 200);
    }

    public function getCommentBasedTime(Request $request, Builder|EBuilder $query)
    {
        if ($request->input('is_last_comment')) {
            $data = $this->commentRepo->getLastComment($query);
            return $data;
        }

        else if ($request->input('is_1_week_comment')) {
            $data = $this->commentRepo->getComment1Week($query);
            return $data;
        } 
        
        elseif ($request->input('is_1_month_comment')) {
            $data = $this->commentRepo->getComment1Month($query);
            return $data;
        } 
        
        elseif ($request->input('is_6_month_comment')) {
            $data = $this->commentRepo->getComment6Months($query);
            return $data;
        } 
        
        elseif ($request->input('is_1_year_comment')) {
            $data = $this->commentRepo->getComment1Year($query);
            return $data;
        } 

        elseif ($request->input('is_more_1_year_comment')) {
            $data = $this->commentRepo->getCommentMore1Year($query);
            return $data;
        } 
        
        else {
            return $query->get();
        }
    }

    public function createComment(array $request)
    {
        $comment = $this->commentRepo->create($request);
        
        return response()->json(['data' => $comment], 201);
    }

    public function editComment(Request $request, Comment $comment)
    {
        
    }

    public function deleteComment(Comment $comment)
    {

    }
}