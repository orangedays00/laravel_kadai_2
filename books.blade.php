	<!-- resources/views/books.blade.php -->
	@extends('layouts.app')
	@section('content')
	    <!-- Bootstrapの定形コード… -->
	    <div class="card-body">
	        <div class="card-title">
	            本のタイトル
	        </div>
	        <!-- バリデーションエラーの表示に使用-->
	    	@include('common.errors')
	        <!-- バリデーションエラーの表示に使用-->
	        <!-- 本登録フォーム -->
	        <form action="{{ url('newbook') }}" method="POST" class="form-horizontal">
	            {{ csrf_field() }}
	            <!-- 本のタイトル -->
	            <div class="form-group">
	                <div class="col-sm-6">
	                    <input type="text" name="item_name" class="form-control">
	                </div>
	            </div>
	            <!-- 本 登録ボタン -->
	            <div class="form-group">
	                <div class="col-sm-offset-3 col-sm-6">
	                    <button type="submit" class="btn btn-primary">
	                        Save
	                    </button>
	                </div>
	            </div>
	        </form>
	    </div>
	    <div class="card-body">
	    	<div class="card-title">
	    		チーム名
	    	</div>
	    	@include('common.errors')
	    	<form action="{{ url('newteam')}}" method="POST" class="form-horizontal">
	    		{{ csrf_field()}}
	    		<div class="form-group">
	    			<div class="col-sm-6">
	    				<input type="text" name="team_name" class="form-control">
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-offset-3 col-sm-6">
	    				<button type="submit" class="btn btn-primary">
	    					Save
	    				</button>
	    			</div>
	    		</div>
	    	</form>
	    </div>
	    <!-- Book: 既に登録されてる本のリスト -->
	    	<!-- 現在の本 -->
	    @if (count($books) > 0)
	        <div class="card-body">
	            <div class="card-body">
	                <table class="table table-striped task-table">
	                    <!-- テーブルヘッダ -->
	                    <thead>
	                        <th>本一覧</th>
	                        <th>&nbsp;</th>
	                    </thead>
	                    <!-- テーブル本体 -->
	                    <tbody>
	                    	<td class="table-text">本のタイトル</td>
	                    	<td>冊数</td>
	                    	<td>値段</td>
	                    	<td>削除</td>
	                    	<td>更新</td>
	                        @foreach ($books as $book)
	                            <tr>
	                                <!-- 本タイトル -->
	                                <td class="table-text">
	                                    <div>{{ $book->item_name }}</div>
                                    </td>
                                    <td>
	                                    <div>{{ $book->item_number }}</div>
                                    </td>
                                    <td>
	                                    <div>{{ $book->item_amount }}</div>
	                                </td>
				        			<!-- 本: 削除ボタン -->
	                                <td>
	                                    <form action="{{ url('book/'.$book->id) }}" method="POST">
                                	        {{ csrf_field() }}
                                	        {{ method_field('DELETE') }}
                                	        <button type="submit" class="btn btn-danger">
                                	            削除
                                	        </button>
                                    	</form>
	                                </td>
                                	<td>
                                		<form action="{{ url('booksedit/'.$book->id) }}" method="GET"> {{ csrf_field() }}
                                		    <button type="submit" class="btn btn-primary">更新 </button>
                                		</form>
                                	</td>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>		
	    @endif
	    @if (count($teams) > 0)
	    	<div class="card-body">
	            <div class="card-body">
	                <table class="table table-striped task-table">
	                    <!-- テーブルヘッダ -->
	                    <thead>
	                        <th>チーム一覧</th>
	                        <th>&nbsp;</th>
	                    </thead>
	                    <!-- テーブル本体 -->
	                    <tbody>
	                    	<td class="table-text">チーム名</td>
	                        @foreach ($teams as $team)
	                            <tr>
	                                <td class="table-text">
	                                    <div>{{ $team->team_name }}</div>
                                    </td>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    @endif
	@endsection