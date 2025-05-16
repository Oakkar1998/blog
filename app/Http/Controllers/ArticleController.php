<?php

namespace App\Http\Controllers;

use App\Models\Love;
use App\Models\Save;
use App\Models\User;
use App\Models\View;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;

use Barryvdh\DomPDF\Facade\Pdf; // <-- Correct import
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\ArticlePublishedNotification;







class ArticleController extends Controller
{
    

    

    public function readArticlePage($articleId)
    {

        
        // dd($article->toArray());
        $userId = auth()->id();
        // $user = Auth::user();
        $article = Article::find($articleId);

        // Record view if not already viewed by this user
        if (!View::where('user_id', $userId)->where('article_id', $articleId)->exists()) {
            View::create([
                'user_id' => $userId,
                'article_id' => $articleId,
            ]);
            
            // Increment the views count on the article
            $article->increment('views');

                // ✅ Notify blogger
            $bloggers = User::where('role', 'blogger')->get();
            $actor = auth()->user();
            foreach ($bloggers as $blogger) {

                $blogger->notify(new ArticlePublishedNotification($article, 'viewed',$actor));
                
                
            }

        }
        
        

        return view('Blog.Article.readArticle', compact('article'));
    }

    public function deleteArticle($articleId)
    {
        $article = Article::find($articleId);

        if (!$article) {
            abort(404); // or handle gracefully
        }

        // Delete image if it exists
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // Delete the article record
        $article->delete();

        // toastr()->warning('deleted successfully.');
        

        return back();
    }

    public function loveArticle($articleId)
    {
        $userId = Auth::id();
    
        $alreadyLoved = Love::where('user_id', $userId)
                            ->where('article_id', $articleId)
                            ->exists();
    
        if (!$alreadyLoved) {
            // Save the love record
            Love::create([
                'user_id' => $userId,
                'article_id' => $articleId
            ]);
    
            // Increment the love count in articles table
            $article = Article::find($articleId);
            $article->increment('love');

            // ✅ Notify blogger
            $bloggers = User::where('role', 'blogger')->get();
            $actor = auth()->user();
            foreach ($bloggers as $blogger) {

                $blogger->notify(new ArticlePublishedNotification($article, 'loved',$actor));
                
                
            };
            
        }

        
    
        return back();
    }

    public function saveArticle($articleId)
    {
        $userId = Auth::id();
    
        $alreadySaved = Save::where('user_id', $userId)
                            ->where('article_id', $articleId)
                            ->exists();
    
        if (!$alreadySaved) {
            // Save the love record
            Save::create([
                'user_id' => $userId,
                'article_id' => $articleId
            ]);
    
            // Increment the love count in articles table
            $article = Article::find($articleId);
            $article->increment('save');

            // ✅ Notify blogger
            $bloggers = User::where('role', 'blogger')->get();
            $actor = auth()->user();
            foreach ($bloggers as $blogger) {

                $blogger->notify(new ArticlePublishedNotification($article, 'saved',$actor));
                
                
            };
        }
    
        return back();
    }

        public function commentArticle(Request $request, $articleId)
    {
        $userId = Auth::id();

        $alreadyCommented = Comment::where('user_id', $userId)
                            ->where('article_id', $articleId)
                            ->exists();

        // Validate only the content
        $request->validate([
            'content' => 'required|max:800|string'
        ]);

        if (!$alreadyCommented) {
            $comment = Comment::create([
                'user_id' => $userId,
                'article_id' => $articleId,
                'content' => $request->content
            ]);

            // Increment comment count in articles table
            $article = Article::with('comments.user')->findOrFail($articleId);



            $article->increment('comments_count'); // Make sure this column exists

            // ✅ Notify blogger
            $bloggers = User::where('role', 'blogger')->get();
            $actor = auth()->user();
            foreach ($bloggers as $blogger) {

                $blogger->notify(new ArticlePublishedNotification($article, 'commented',$actor));
                
                
            };

        }
        
        return back()->with('success', $alreadyCommented ? 'You already commented.' : 'Comment added!');
    }

    public function deleteComment($id){
        // dd($id);
        
        $comment = Comment::findOrFail($id);
        $user = Auth::user();

        // if ($comment->user_id !== $user->id && $comment->article->user_id !== $user->id) {
        //     abort(403, 'Unauthorized');
        // }

        $comment->delete();

        // Optional: decrement comment count in article
        $comment->article->decrement('comments_count');

        return back()->with('success', 'Comment deleted.');
    }

    public function editComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $user = Auth::user();

        // Only the comment owner
        if ($comment->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'content' => 'required|max:800'
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Comment updated.');
    }

            public function downloadPDF($id)
    {
        $pdfArticle = Article::with('category')->findOrFail($id);
        // $convertedBody = Rabbit::zg2uni($pdfArticle->content); // Convert Zawgyi to Unicode
        // $unicodeText = Converter::zg2uni($pdfArticle->content);

        $article = [
            'title'    => $pdfArticle->title,
            'author'   => $pdfArticle->author ?? 'Unknown',
            'date'     => $pdfArticle->created_at->format('F j, Y'),
            'body'     => $pdfArticle->content,
            'image'    => $pdfArticle->image
                ? public_path('storage/' . $pdfArticle->image)
                : public_path('BlogTem/html-magazine-template.jpg'),
            'category' => optional($pdfArticle->category)->name ?? 'Uncategorized',
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.article', ['article' => $article]);
        
        

        
        return $pdf->download('article.pdf');
        

    }




    

}
