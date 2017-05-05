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

<section class="todoapp" id="app">

<header class="header">
	<h1>Todos</h1>
	<input class="new-todo" id="title" name="title" placeholder="What needs to be done?" autofocus v-model="todo" @keyup.enter="add">
</header>

<!-- This section should be hidden by default and shown when there are todos -->
<section class="main">
	<input class="toggle-all" type="checkbox">
	<label for="toggle-all">Mark all as complete</label>
	<ul class="todo-list">
		
		<li class="completed" v-for="todo in filteredTodos">
			<todo-tile :todo="todo"></todo-tile>
		</li>
		
	</ul>
</section>
<!-- This footer should hidden by default and shown when there are todos -->
<footer class="footer">
	<!-- This should be `0 items left` by default -->
	<span class="todo-count"><strong>@{{activeItems}}</strong> item(s) left</span>
	<!-- Remove this if you don't implement routing -->
	<ul class="filters">
		<li>
			<a :class="{ selected: visibility == 'all' }"
			   href="#" @click="filterAll($event)"
			>All</a>
		</li>
		<li>
			<a href="#" 
			   :class="{ selected: visibility == 'active' }"
			   @click="filterActive($event)">Active</a>
		</li>
		<li>
			<a href="#" 
			   :class="{ selected: visibility == 'completed' }"
			   @click="filterCompleted($event)">Completed</a>
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