<?php

namespace App\Services;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Post::query();

        $postOfUser = $query->where('user_id', $user->id);

        $data = $this->getPostBasedTime($request, $postOfUser);

        if (!$data) {
            return response()->json(null, 404);
        }

        return response()->json(['data' => $data], 200);
    }

    public function getPostBasedTime(Request $request, Builder|EBuilder $query)
    {
        if ($request->input('is_last_post')) {
            $data = $this->postRepository->getLastPost($query);
            return $data;
        }

        else if ($request->input('is_1_week_post')) {
            $data = $this->postRepository->getPost1Week($query);
            return $data;
        } 
        
        elseif ($request->input('is_1_month_post')) {
            $data = $this->postRepository->getPost1Month($query);
            return $data;
        } 
        
        elseif ($request->input('is_6_month_post')) {
            $data = $this->postRepository->getPost6Months($query);
            return $data;
        } 
        
        elseif ($request->input('is_1_year_post')) {
            $data = $this->postRepository->getPost1Year($query);
            return $data;
        } 

        elseif ($request->input('is_more_1_year_post')) {
            $data = $this->postRepository->getPostMore1Year($query);
            return $data;
        } 
        
        else {
            return;
        }
    }

    public function createPost($request)
    {
        $validator = $request->validated();

        $validator['user_id'] = auth()->user()->id;

        $post =  $this->postRepository->create($validator);

        return response()->json(['data' => $post], 201);
    }

    public function editPost($request, $post)
    {
        $user = $post->user_id;

        if (!isset($user)) {
            return abort(400);
        }
        
        $validator = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $tmpArr = array(
            'user_id' => $user,
            'updated_at' => Carbon::now()
        );

        $postUpdate = $this->postRepository->update($post->id, array_merge($validator, $tmpArr));

        return response()->json([
            'message' => 'Get post success!',
            'data' => $postUpdate
        ], 200);
    }

    public function deletePost($post)
    {
        $check = $this->postRepository->delete($post->id);

        if ($check) {
            return response()->json(null, 204);
        }
    }
}