import {} from './Bootstrap';
import TodoComponent from './TodoComponent.vue';

Vue.component('todo-tile', TodoComponent);

// visibility filters
var filters = {
  all: function (todos) {
    return todos
  },
  active: function (todos) {
    return todos.filter(function (todo) {
      return !todo.complete
    })
  },
  completed: function (todos) {
    return todos.filter(function (todo) {
      return todo.complete
    })
  }
}

var transformers = {
    
    activeToIds: function(todos) {

      return todos.filter( todo => {
          return todo.complete;
      }).map( todo => {
          return todo.id;
      }).join(',');

    }
}

new Vue({
	el: '#app',
	data: {
		todo: '',
		todos: [],
		visibility: 'all'
	},
	created: function(){
    		
        this.makeTodo = (id, title) => {
          return { id: id, title: title, complete: false };
        },
        
        this.addTodo = (id, title) => {
        	if( title ) this.todos.push( this.makeTodo(id, title) );  	
        }
        
        this.$bus.$on('todo-state-changed', todo => {
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

    	filteredTodos: function () {
	      return filters[this.visibility](this.todos)
	    },

    	activeItems: function() {
    		return this.todos.filter( (todo) => {
    			return !todo.complete;
    		}).length;
    	}

    },
    methods: {
    	add: function() {
    		
      		let todo = {
      			title: this.todo,
      			complete: false
      		};

      		this.$http.post('/todos', todo).then( function(res){
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
      },

      deleteCompleted: function() {

          let ids = transformers['activeToIds'](this.todos);
          this.$http.delete('/todos/delete/multi?ids=' + ids).then( function(){
              this.todos = filters['active'](this.todos);
          });
      },

      filterAll: function(e) {
      		e.preventDefault();
      		this.visibility = 'all';
      },

      filterActive: function(e) {
      		e.preventDefault();
	       	this.visibility = 'active';
	    },

	    filterCompleted: function(e) {
	    	e.preventDefault();
	    	this.visibility = 'completed';
	    }

    }

})