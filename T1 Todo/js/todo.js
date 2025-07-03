const taskInput = document.getElementById("taskInput");
const dateInput = document.getElementById("dateInput");
const addTaskBtn = document.getElementById("addTaskBtn");
const taskList = document.getElementById("taskList");
const filterButtons = document.querySelectorAll(".filter-btn");

// fetch task from local storage
let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

function renderTasks(filter = "all") {
  taskList.innerHTML = "";

  const filteredTasks = tasks.filter((task) => {
    if (filter === "all") return true;
    if (filter === "completed") return task.completed;
    if (filter === "pending") return !task.completed;
  });

  filteredTasks.forEach((task, index) => {
    const li = document.createElement("li");
    li.className = task.completed ? "completed" : "";

    li.innerHTML = `
      <input type="checkbox" ${
        task.completed ? "checked" : ""
      } onchange="toggleTask(${index})">
      <span>${task.text} (${task.date})</span>
      <button onclick="editTask(${index})">Edit</button>
      <button onclick="deleteTask(${index})">Delete</button>
    `;

    taskList.appendChild(li);
  });
}

// add task
addTaskBtn.addEventListener("click", () => {
  const text = taskInput.value.trim();
  const date = dateInput.value || new Date().toLocaleDateString();

  if (text === "") {
    alert("Please enter a task");
    return;
  }

  tasks.push({
    text,
    date,
    completed: false,
  });

  saveTasks();
  renderTasks();
  taskInput.value = "";
  dateInput.value = "";
});

function toggleTask(index) {
  tasks[index].completed = !tasks[index].completed;
  saveTasks();
  renderTasks();
}

// edit task
function editTask(index) {
  const newText = prompt("Edit your task:", tasks[index].text);
  if (newText !== null && newText.trim() !== "") {
    tasks[index].text = newText.trim();
    saveTasks();
    renderTasks();
  }
}

// delete task
function deleteTask(index) {
  if (confirm("Are you sure you want to delete this task?")) {
    tasks.splice(index, 1);
    saveTasks();
    renderTasks();
  }
}

// save in local storage
function saveTasks() {
  localStorage.setItem("tasks", JSON.stringify(tasks));
}

// filter tasks
filterButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    document.querySelector(".filter-btn.active").classList.remove("active");
    btn.classList.add("active");
    const filter = btn.getAttribute("data-filter");
    renderTasks(filter);
  });
});

// initial render
renderTasks();
