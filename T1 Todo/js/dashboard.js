// Greeting and Time
const greetingEl = document.getElementById("greeting");
const dateTimeEl = document.getElementById("dateTime");

// Function for greeting
function updateGreeting() {
  const now = new Date();
  const hour = now.getHours();
  let greeting = "";

  if (hour < 12) {
    greeting = "Good Morning ☀️";
  } else if (hour < 18) {
    greeting = "Good Afternoon 🌤️";
  } else {
    greeting = "Good Evening 🌙";
  }

  greetingEl.textContent = greeting;
  dateTimeEl.textContent = now.toLocaleString();
}

// Call greeting function every second to update time
setInterval(updateGreeting, 1000);
updateGreeting();

// Load Task Count from localStorage
const tasks = JSON.parse(localStorage.getItem("tasks")) || [];
const todayTasks = tasks.filter((task) => {
  const today = new Date().toLocaleDateString();
  return task.date === today;
});
document.getElementById("taskCount").textContent = `${todayTasks.length} Tasks`;

// Load Notes Count from localStorage
const notes = JSON.parse(localStorage.getItem("notes")) || [];
document.getElementById("noteCount").textContent = `${notes.length} Notes`;
