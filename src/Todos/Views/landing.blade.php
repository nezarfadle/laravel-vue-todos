<style type="text/css">
/*
.text-todo {
	padding: 10px;
	width: 100%;
	border: 0px;
}

.text-todo:focus {
	background-color: #f0f4c3;
	border: 1px;
}
*/
</style>
@extends('layout')
@section('content')

<section class="todoapp">

<header class="header">
	<h1>Todos</h1>
	<input class="new-todo" placeholder="What needs to be done?" autofocus>
</header>

<!-- This section should be hidden by default and shown when there are todos -->
<section class="main" id="app">
	<input class="toggle-all" type="checkbox">
	<label for="toggle-all">Mark all as complete</label>
	<ul class="todo-list">
		
		<li class="completed" v-for="todo in todos">

			<todo-tile :todo="todo"></todo-tile>
			{{-- <div class="view">
				<input class="toggle" type="checkbox" checked>
				<label>
					<input type="text" class="text-todo" v-model="todo.title">
				</label>
				<button class="destroy"></button>
			</div> --}}
		</li>
		
	</ul>
</section>
<!-- This footer should hidden by default and shown when there are todos -->
<footer class="footer">
	<!-- This should be `0 items left` by default -->
	<span class="todo-count"><strong>0</strong> item left</span>
	<!-- Remove this if you don't implement routing -->
	<ul class="filters">
		<li>
			<a class="selected" href="#/">All</a>
		</li>
		<li>
			<a href="#/active">Active</a>
		</li>
		<li>
			<a href="#/completed">Completed</a>
		</li>
	</ul>
	<!-- Hidden if no completed items are left ↓ -->
	<button class="clear-completed">Clear completed</button>
</footer>
</section>
<footer class="info">
<p>Template by <a href="http://sindresorhus.com">Sindre Sorhus</a></p>
<p>
<a href="https://github.com/tastejs/todomvc-app-template/">
Template on Github
</a>
</p>
</footer>

@endsection

@section('js')
<script src="{{asset('js/todos/todos.bundle.js')}}"></script>
@endsection