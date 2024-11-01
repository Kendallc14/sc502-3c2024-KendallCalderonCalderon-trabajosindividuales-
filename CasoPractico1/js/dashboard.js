document.addEventListener('DOMContentLoaded', function(){

    const tasks = [{
        id: 1,
        title: "Complete project report",
        description: "Prepare and submit the project report",
        dueDate: "2024-12-01",
        comments: []
    },
    {
        id:2,
        title: "Team Meeting",
        description: "Get ready for the season",
        dueDate: "2024-12-01",
        comments: []
    },
    {
        id: 3,
        title: "Code Review",
        description: "Check partners code",
        dueDate: "2024-12-01",
        comments: []
    }];
    
    function loadTasks(){
        const taskList = document.getElementById('task-list');
        taskList.innerHTML = '';

        tasks.forEach(function(task){
            let commentsList = '';
            if (task.comments && task.comments.length > 0) {
                commentsList = '<ul class="list-group list-group-flush">';
                task.comments.forEach(comment => {
                    commentsList += `<li class="list-group-item">${comment.description}
                        <button type="button" class="btn btn-sm btn-link remove-comment" data-id="${task.id}-${comment.id}">Remove</button>
                    </li>`;
                });
                commentsList += '</ul>';
            } else {
                commentsList = '<p>No hay comentarios realizados.</p>';
            }       

            const taskCard = document.createElement('div');
            taskCard.className = 'col-md-4 mb-3';
            taskCard.innerHTML =`
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${task.title}</h5>
                        <p class="card-text">${task.description}</p>
                        <p class="card-text"><small class="text-muted">Due: ${task.dueDate}</small></p>
                        <div>${commentsList}</div>
                        <div class="input-group mt-2">
                            <input type="text" class="form-control comment-input" placeholder="Add a comment" data-task-id="${task.id}">
                            <button class="btn btn-primary btn-sm add-comment" data-task-id="${task.id}">Add</button>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button class="btn btn-secondary btn-sm edit-task" data-id="${task.id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">Delete</button>
                    </div>
                </div>
            `;
            taskList.appendChild(taskCard);
        });

        document.querySelectorAll('.edit-task').forEach(function(button){
            button.addEventListener('click', handleEditTask);
        });

        document.querySelectorAll('.delete-task').forEach(function(button){
            button.addEventListener('click', handleDeleteTask);
        });

        document.querySelectorAll('.add-comment').forEach(function(button){
            button.addEventListener('click', addComment)
        } );

        document.querySelectorAll('.remove-comment').forEach(function(button){
            button.addEventListener('click', removeComment)
        });
         
    }

    function addComment(event){
        const taskId = parseInt(event.target.dataset.taskId);
        const commentInput = document.querySelector(`.comment-input[data-task-id="${taskId}"]`);
        const commentText = commentInput.value.trim();

        if (commentText) {
            const task = tasks.find(task => task.id === taskId);
            const newComment = { id: Date.now(), description: commentText };
            task.comments.push(newComment);

            commentInput.value = ''; 
            loadTasks(); 
        }
    }


    function removeComment(event) {
        const [taskId, commentId] = event.target.getAttribute('data-id').split('-').map(Number);

        const task = tasks.find(task => task.id === taskId);
        task.comments = task.comments.filter(comment => comment.id !== commentId);
    
        loadTasks(); // Recargar las tareas para actualizar los comentarios
    }

    
    /* NO ME FUNCIONO CORRECTAMENTE Y TUVE QUE CAMBIAR LA FUNCION 
    
    function removeComment(event) {
        const taskId = parseInt(event.target.getAttribute('data-task-id'));
        const commentId = parseInt(event.target.getAttribute('data-comment-id'));

        const task = tasks.find(task => task.id === taskId);
        task.comments = task.comments.filter(comment => comment.id !== commentId);

        loadTasks(); // Recargar las tareas para actualizar los comentarios
    }

*/
    function handleEditTask(event){
        //abrir el modal y mostrar los datos
        alert(event.target.dataset.id);
    }


    function handleDeleteTask(event){
        alert(event.target.dataset.id);
    }

    

    document.getElementById('task-form').addEventListener('submit', function(e){
        e.preventDefault();
        alert("crear tarea");
        //TODO: 
        //1. obtener los datos de la tarea
        //2. agregar una tarea al array de tareas
        //3. llamar a load task

    });



    loadTasks();

});