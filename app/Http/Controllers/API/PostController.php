<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Http\Controllers\API\BaseController as BaseController;
use function PHPUnit\Framework\fileExists;

class PostController extends BaseController
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $data['data'] = Post::all();
      return $this->sendResponse($data, 'All post data');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      $validateUser = Validator::make(
         $request->all(),
         [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
         ]
      );

      if ($validateUser->fails()) {
         return $this->sendError('Validation error', $validateUser->errors()->all());
      }

      $file = $request->image;
      $filename = uniqid() . '.' . $file->getClientOriginalExtension();
      $destinationPath = public_path('/uploads');
      $file->move($destinationPath, $filename);

      $post = Post::create([
         'title' => $request->title,
         'description' => $request->description,
         'image' => $filename
      ]);

      return $this->sendResponse($post, 'Post created successfully');
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      $data['post'] = Post::select(
         'id',
         'title',
         'description',
         'image'
      )->where(['id' => $id])->get();
      return $this->sendResponse($data['post'], 'Show post data');
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      $validateUser = Validator::make(
         $request->all(),
         [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
         ]
      );

      if ($validateUser->fails()) {
         return $this->sendError('Validation error', $validateUser->errors()->all());
      }

      $postImage = Post::select('id', 'image')->where(['id' => $id])->get();
      if ($request->image != "") {
         $path = public_path('/uploads');
         if ($postImage[0]->image != "" && $postImage[0]->image != null) {
            $old_file = $path . "/" . $postImage[0]->image;
            if (fileExists($old_file)) {
               unlink($old_file);
            }
         }
         $file = $request->image;
         $filename = uniqid() . '.' . $file->getClientOriginalExtension();
         $destinationPath = public_path('/uploads');
         $file->move($destinationPath, $filename);
      } else {
         $filename = $postImage[0]->image;
      }

      $post = Post::where(['id' => $id])->update([
         'title' => $request->title,
         'description' => $request->description,
         'image' => $filename
      ]);

      return $this->sendResponse($post, 'Post updated successfully');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      $post = Post::where(['id' => $id])->delete();
      return $this->sendResponse($post, 'Your Post has been removed.');
   }
}
