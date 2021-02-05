<?php

use App\Book;
use App\Team;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 本のダッシュボード表示(books.blade.php)
Route::get('/', function () {
    $books = Book::orderBy('created_at', 'asc')->get();
    $teams = Team::orderBy('created_at', 'asc')->get();
    return view('books', [
        'books' => $books,
        'teams' => $teams //teamsテーブルのデータを代入する
    ]);
    //return view('books',compact('books')); //も同じ意味
});

// 新「本」を追加
Route::post('/newbook', function (Request $request) {
    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    	// Eloquent モデル
	$books = new Book;
	$books->item_name = $request->item_name;
	$books->item_number = '1';
	$books->item_amount = '1000';
	$books->published = '2017-03-07 00:00:00';
	$books->save(); 
	return redirect('/');
});

// 本を削除
Route::delete('/book/{book}', function (Book $book) {
    $book->delete();       //追加
    return redirect('/');  //追加
});

//「本」を更新画面表示
Route::get('/booksedit/{book}',function(Book $book){
return view('booksedit', ['book' => $book]);
});
//「本」を更新処理
Route::post('books/update',function(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    // Eloquent モデル
    $books = Book::find($request->id);
    $books->item_name = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published = date("Y-m-d H:i:s");
    $books->save(); 
    return redirect('/');
});

Route::post('/newteam', function(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
        'team_name' => 'required|max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    	// Eloquent モデル
	$teams = new Team;
	$teams->team_name = $request->team_name;
	$teams->published = date("Y-m-d H:i:s");
	$teams->save(); 
	return redirect('/');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
