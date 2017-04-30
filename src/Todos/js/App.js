import {} from './bootstrap';
import TodoComponent from './TodoComponent.vue';

Vue.component('todo-tile', TodoComponent);

new Vue({
	el: '#app',
	data: {
		todos: [ { title: 'Todo 1'}, { title: 'Todo 2'} ]
	},
	created: function(){
    		
        this.makeTodo = title => {
          return { title: title, complete: false };
        },
        
        this.addTodo = title => {
        	if( title ) this.todos.push( this.makeTodo(title) );  	
        }
        
        this.$bus.$on('todo-state-changed', todo => {
        	alert('Send an ajax request to change the state ' + todo.complete );
        })
        
        this.$bus.$on('todo-title-changed', todo => {
        	alert('Send an ajax request to change the title ' + todo.title);
        })
        
    }

})