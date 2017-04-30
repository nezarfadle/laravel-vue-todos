import {} from './Bootstrap';
import TodoComponent from './TodoComponent.vue';

Vue.component('todo-tile', TodoComponent);

new Vue({
	el: '#app',
	data: {
		todo: '',
		todos: []
	},
	created: function(){
    		
        this.makeTodo = (id, title) => {
          return { id: id, title: title, complete: false };
        },
        
        this.addTodo = (id, title) => {
        	if( title ) this.todos.push( this.makeTodo(id, title) );  	
        }
        
        this.$bus.$on('todo-state-changed', todo => {
        	// alert('Send an ajax request to change the state ' + todo.complete );
        	this.update( todo );
        })
        
        this.$bus.$on('todo-title-changed', todo => {
        	this.update( todo );
        })

        this.$bus.$on('todo-delete', todo => {
        	this.deleteTodo( todo );
        })
        
        this.$http.get('/todos').then( function(res){
        	this.todos = res.data.data;
        })

    },

    computed: {
    	activeItems: function() {
    		return this.todos.filter( (todo) => {
    			return !todo.complete;
    		}).length;
    	}
    },
    methods: {
    	add: function() {
    		
    		var data = {
    			title: this.todo,
    			complete: false
    		};

    		this.$http.post('/todos', data).then( function(res){
    			let newTodoId = res.data.id;
	        	this.addTodo( newTodoId, this.todo );
	        	this.todo = '';
    		});

      	},

      	update: function(todo) {      		
      		this.$http.put('/todos/' + todo.id, todo);
      	},

      	deleteTodo: function(todo) {

      		this.$http.delete('/todos/' + todo.id).then(function(){
      			let index = this.todos.indexOf(todo);
      			this.todos.splice( index, 1 );
      		})
      	}
    }

})