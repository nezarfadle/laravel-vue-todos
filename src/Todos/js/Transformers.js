export default {
    
    activeToIds: function(todos) {

      return todos.filter( todo => {
          return todo.complete;
      }).map( todo => {
          return todo.id;
      }).join(',');

    }
    
}