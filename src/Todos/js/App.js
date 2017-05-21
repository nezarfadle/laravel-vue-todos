import {} from './Bootstrap';
import TodoComponent from './TodoComponent.vue';
import filters from './Filters.js'
import transformers from './Transformers.js'

Vue.component('todo-tile', TodoComponent);

new Vue({
	el: '#app',
	data: {
		todo: '',
		todos: [],
		visibility: 'all'
	},
	created: function(){
    
        this.addTodo = (todo) => {
        	this.todos.push( todo );  	
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
  	        	this.addTodo( res.data.todo );
  	        	this.todo = '';
      		});

      },

      update: function(todo) {      		
      		this.$http.put( todo.href, todo);
      },

      deleteTodo: function(todo) {
      		this.$http.delete( todo.href ).then(function(){
      			let index = this.todos.indexOf(todo);
      			this.todos.splice( index, 1 );
      		})
      },

      deleteCompleted: function() {

          let ids = transformers['activeToIds'](this.todos);
          this.$http.delete('/todos/mark/completed?ids=' + ids).then( function(){
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