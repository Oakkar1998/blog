<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use App\Notifications\ArticlePublishedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatorStudioController extends Controller
{
    public function creatorStudioPage()
    {
        $creator_id = Auth::user()->id;
        $creator    = User::find($creator_id);

        return view('Blog.CreatorStudio.BlogManagement.creatorStudioPage', compact('creator'));
    }

    public function articlePage()
    {
        $articles = Article::latest()->paginate(4);
        return view('Blog.CreatorStudio.BlogManagement.articlePage', compact('articles'));
    }

    public function createArticlePage()
    {
        $get_Cate = Category::select('name', 'id')->get();
        return view('Blog.CreatorStudio.BlogManagement.createArticlePage', compact('get_Cate'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:2|max:100|unique:articles,title',
            'author'      => 'required|min:1|max:30',
            'category_id' => 'required',
            'content'     => 'required|max:10000',
            'image'       => 'nullable|file|max:2048|mimes:jpg,jpeg,webp',
        ]);

        $data = $request->only(['title', 'author', 'content', 'category_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $data['user_id'] = Auth::id();

        // ✅ Create and store the article in a variable
        $article = Article::create($data);

        // ✅ Notify all readers
        $readers = User::where('role', 'reader')->get();
        $actor   = auth()->user();
        foreach ($readers as $reader) {

            $reader->notify(new ArticlePublishedNotification($article, 'published', $actor));

        }

        return to_route('creator.articlePage');
    }

    public function editArticlePage($id)
    {
        $article  = Article::find($id);
        $get_Cate = Category::select('name', 'id')->get();
        return view('Blog.CreatorStudio.BlogManagement.editArticlePage', compact('article', 'get_Cate'));
    }

    public function editArticle(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'title'       => 'required|min:2|max:100',
            'author'      => 'required|min:1|max:30',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|max:10000',
            'image'       => 'nullable|file|max:2048|mimes:jpg,jpeg,webp',
        ]);

        // Find the article
        $article = Article::findOrFail($id);

        // Update article fields
        $article->title       = $validated['title'];
        $article->author      = $validated['author'];
        $article->category_id = $validated['category_id'];
        $article->content     = $validated['content'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            // Store new image
            $imagePath      = $request->file('image')->store('images', 'public');
            $article->image = $imagePath;
        }

        // Save changes
        $article->save();

        // Redirect or return response
        return to_route('creator.articlePage')
            ->with('success', 'Article updated successfully.');
    }

    public function viewArticlePage($id)
    {
        $article = Article::find($id);
        return view('Blog.CreatorStudio.BlogManagement.viewArticlePage', compact('article'));
    }

    public function categoryPage()
    {
        $categories = Category::latest()->paginate(5); // same as orderBy('created_at', 'desc')
        return view('Blog.CreatorStudio.BlogManagement.categoryPage', compact('categories'));
    }

    public function createCategory(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min:2|max:30|string|unique:categories,name,',
        ]);

        $cate = Category::create($data);

        return back();
    }

    public function deleteCategory($categoryId)
    {

        $category = Category::find($categoryId);

        $category->delete();

        return back();
    }

    public function editCategory(Request $request, $cateId)
    {
        $category = Category::findOrFail($cateId);

        $data = $request->validate([
            'category_name' => 'required|min:2|max:30|string|unique:categories,name,' . $cateId,
        ]);

        $category->name = $request->category_name;

        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function uploadCreatorImage(Request $request)
    {
        $user = Auth::user();

        // Validate image (optional)
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image && Storage::disk('public')->exists($user->image) && $user->image != null) {
                Storage::disk('public')->delete($user->image);
            }

            // Store new image
            $path        = $request->file('image')->store('ProfileImage', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'photo updated.');
    }

    //all users page
    public function allusersPage()
    {

        $all_users = User::where('role', 'reader')->latest()->paginate(10);
        return view('Blog.CreatorStudio.UserManagement.allUsersPage', compact('all_users'));
    }

    //deleteUser
    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Optional: prevent deleting currently logged-in user
        // if (auth()->id() == $user->id) {
        //     return redirect()->back()->with('error', 'You cannot delete your own account.');
        // }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // Note
    public function notePage()
    {
        $note = Note::first(); // gets the first (and only) note row
        return view('Blog.CreatorStudio.BlogManagement.notePage', compact('note'));
    }

    public function createNote(Request $request)
    {
        $data = $request->validate([
            'note'  => 'required|min:3|max:100',
            'image' => 'nullable|file|max:1024|mimes:png,jpg,jpeg,webp', // max 1MB
        ]);

        $existingNote = Note::first();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notes', 'public');

            // Delete old image if it exists
            if ($existingNote && $existingNote->image) {
                Storage::disk('public')->delete($existingNote->image);
            }

            $data['image'] = $imagePath; // save image path to DB
        }

        if ($existingNote) {
            $existingNote->update($data);
        } else {
            Note::create($data);
        }

        return redirect()->back()->with('success', 'Note saved successfully.');
    }

}
