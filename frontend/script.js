// Load todos from localStorage
let todos = JSON.parse(localStorage.getItem("todos")) || [];
const todoList = document.getElementById("todoList");

function renderTodos() {
  todoList.innerHTML = "";
  todos.forEach((todo, index) => {
    const li = document.createElement("li");
    li.className = "todo-item";

    const span = document.createElement("span");
    span.textContent = todo;

    const delBtn = document.createElement("button");
    delBtn.textContent = "Delete";
    delBtn.className = "delete-btn";
    delBtn.onclick = () => deleteTodo(index);

    li.appendChild(span);
    li.appendChild(delBtn);
    todoList.appendChild(li);
  });
}

function addTodo() {
  const input = document.getElementById("todoInput");
  const todoText = input.value.trim();
  if (todoText === "") {
    alert("Please enter a todo!");
    return;
  }
  todos.push(todoText);
  localStorage.setItem("todos", JSON.stringify(todos));
  input.value = "";
  renderTodos();
}

function deleteTodo(index) {
  todos.splice(index, 1);
  localStorage.setItem("todos", JSON.stringify(todos));
  renderTodos();
}

function logout() {
  window.location.href = "signup.html";
}

// Initial render
renderTodos();
