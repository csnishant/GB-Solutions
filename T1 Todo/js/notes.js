const noteTitle = document.getElementById("noteTitle");
const noteContent = document.getElementById("noteContent");
const addNoteBtn = document.getElementById("addNoteBtn");
const notesContainer = document.getElementById("notesContainer");
const wordCounter = document.getElementById("wordCounter");

// Load notes from localStorage
let notes = JSON.parse(localStorage.getItem("notes")) || [];

// Render Notes
function renderNotes() {
  notesContainer.innerHTML = "";

  if (notes.length === 0) {
    notesContainer.innerHTML = "<p>No notes yet.</p>";
    return;
  }

  notes.forEach((note, index) => {
    const div = document.createElement("div");
    div.className = "note-card";

    div.innerHTML = `
      <h3>${note.title}</h3>
      <p>${note.content}</p>
      <div class="note-actions">
        <button onclick="editNote(${index})">Edit</button>
        <button onclick="deleteNote(${index})">Delete</button>
      </div>
    `;

    notesContainer.appendChild(div);
  });
}

// Add Note
addNoteBtn.addEventListener("click", () => {
  const title = noteTitle.value.trim();
  const content = noteContent.value.trim();

  if (title === "" || content === "") {
    alert("Please fill in both title and content.");
    return;
  }

  notes.push({ title, content });
  saveNotes();
  renderNotes();

  noteTitle.value = "";
  noteContent.value = "";
  updateCounter();
});

// Edit Note
function editNote(index) {
  const newTitle = prompt("Edit title:", notes[index].title);
  const newContent = prompt("Edit content:", notes[index].content);

  if (
    newTitle !== null &&
    newContent !== null &&
    newTitle.trim() &&
    newContent.trim()
  ) {
    notes[index].title = newTitle.trim();
    notes[index].content = newContent.trim();
    saveNotes();
    renderNotes();
  }
}

// Delete Note
function deleteNote(index) {
  if (confirm("Are you sure you want to delete this note?")) {
    notes.splice(index, 1);
    saveNotes();
    renderNotes();
  }
}

// Save to localStorage
function saveNotes() {
  localStorage.setItem("notes", JSON.stringify(notes));
}

// Word and Character Counter
function updateCounter() {
  const words = noteContent.value
    .trim()
    .split(/\s+/)
    .filter((word) => word.length > 0);
  const characters = noteContent.value.length;
  wordCounter.textContent = `Words: ${words.length} | Characters: ${characters}`;
}

noteContent.addEventListener("input", updateCounter);

// Initial render
renderNotes();
updateCounter();
