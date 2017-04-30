<template>
	<div class="view">
		<input class="toggle" 
			   type="checkbox" 
			   v-model="todo.complete"
			   @click="updateState(todo)"
		>
		<label>
			<input type="text" class="text-todo" 
				   v-model="todo.title" 
				   @blur="lostFocus(todo)"
			>
		</label>
		<button class="destroy" @click="deleteTodo(todo)"></button>
	</div>
</template>

<style scoped>

.text-todo {
	padding: 10px;
	width: 100%;
	border: 0px;
}
.text-todo:focus {
	background-color: #f0f4c3;
	border: 1px;
}

</style>

<script>
	export default {
		
		props: [ 'todo' ],
		data() {
		  	return {
		    	oldValue: ''
		    }
	  	},
	  	created: function() {
		  	this.oldValue = this.todo.title ;
		},
		methods: {
  	
		    toggle: function(todo) {
		      todo.complete = !todo.complete;
		   		this.$bus.$emit('todo-state-changed', todo);
		    },
		    
		    lostFocus: function(todo) {
		    	
		        if( this.oldValue != todo.title && todo.title != '' ) {
		        	this.oldValue = todo.title;
		        	this.$bus.$emit('todo-title-changed', todo);
		        }
		        
		    },

		    updateState: function(todo) {
		        this.$bus.$emit('todo-state-changed', todo);
		    },

		    deleteTodo: function(todo) {
		        this.$bus.$emit('todo-delete', todo);
		    }
		}

	}
</script>