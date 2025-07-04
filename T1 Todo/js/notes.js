document.addEventListener("DOMContentLoaded", () => {
  const noteTitle = document.getElementById("noteTitle");
  const noteContent = document.getElementById("noteContent");
  const noteCategory = document.getElementById("noteCategory");
  const addNoteBtn = document.getElementById("addNoteBtn");
  const notesContainer = document.getElementById("notesContainer");
  const wordCounter = document.getElementById("wordCounter");

  // Custom dropdown
  const dropdownBtn = document.getElementById("dropdownButton");
  const dropdownOptions = document.getElementById("dropdownOptions");

  // Modal elements
  const editModal = document.getElementById("editModal");
  const modalTitle = document.getElementById("modalTitle");
  const modalCategory = document.getElementById("modalCategory");
  const modalContent = document.getElementById("modalContent");
  const saveModalBtn = document.getElementById("saveModalBtn");
  const cancelModalBtn = document.getElementById("cancelModalBtn");
  const closeModal = document.getElementById("closeModal");

  //card backround color
  const categoryColors = {
    Personal: "#ffe0e0", // light red
    Work: "#e0f7ff", // light blue
    Academic: "#e6ffe0", // light green
    Default: "#f4f4f4", // fallback gray
  };
  let currentEditIndex = null;
  let notes = JSON.parse(localStorage.getItem("notes")) || [];

  // Render Notes
  function renderNotes() {
    notesContainer.innerHTML = "";

    const selectedCategory = dropdownBtn.textContent.trim();
    const filteredNotes =
      selectedCategory === "All"
        ? notes
        : notes.filter((note) => note.category === selectedCategory);

    if (filteredNotes.length === 0) {
      notesContainer.innerHTML = "<p>No notes found.</p>";
      return;
    }

    filteredNotes.forEach((note, index) => {
      const div = document.createElement("div");
      div.className = "note-card";

      div.className = "note-card";
      const bgColor = categoryColors[note.category] || categoryColors.Default;
      div.style.backgroundColor = bgColor;

      div.innerHTML = `
        <div class="note-content" id="note-${index}">
          <h3>${note.title}</h3>
          <h4>${note.category}</h4>
          <p>${note.content}</p>
          <div class="note-actions">
            <button onclick="enableEdit(${index})">Edit</button>
            <button onclick="deleteNote(${index})">Delete</button>
          </div>
        </div>
      `;
      notesContainer.appendChild(div);
    });
  }

  // Add Note
  addNoteBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const title = noteTitle.value.trim();
    const content = noteContent.value.trim();
    const category = noteCategory.value.trim();

    if (!title || !content || !category) {
      alert("Please fill in all fields.");
      return;
    }

    notes.push({ title, content, category });
    saveNotes();
    renderNotes();

    noteTitle.value = "";
    noteContent.value = "";
    noteCategory.value = "";
    updateCounter();
  });

  // Edit Note (Modal)
  window.enableEdit = function (index) {
    currentEditIndex = index;
    const note = notes[index];
    modalTitle.value = note.title;
    modalCategory.value = note.category;
    modalContent.value = note.content;
    editModal.style.display = "flex";
  };

  saveModalBtn.addEventListener("click", () => {
    const title = modalTitle.value.trim();
    const category = modalCategory.value.trim();
    const content = modalContent.value.trim();

    if (!title || !category || !content) {
      alert("Please fill in all fields.");
      return;
    }

    notes[currentEditIndex] = { title, category, content };
    saveNotes();
    renderNotes();
    editModal.style.display = "none";
  });

  cancelModalBtn.addEventListener("click", () => {
    editModal.style.display = "none";
  });

  closeModal.addEventListener("click", () => {
    editModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === editModal) {
      editModal.style.display = "none";
    }
  });

  // Delete Note
  window.deleteNote = function (index) {
    notes.splice(index, 1);
    saveNotes();
    renderNotes();
  };

  // Save to localStorage
  function saveNotes() {
    localStorage.setItem("notes", JSON.stringify(notes));
  }

  // Word Counter
  function updateCounter() {
    const words = noteContent.value.trim().split(/\s+/).filter(Boolean);
    const characters = noteContent.value.length;
    wordCounter.textContent = `Words: ${words.length} | Characters: ${characters}`;
  }

  noteContent.addEventListener("input", updateCounter);

  // Custom Dropdown
  dropdownBtn.addEventListener("click", () => {
    dropdownOptions.style.display =
      dropdownOptions.style.display === "block" ? "none" : "block";
  });

  dropdownOptions.addEventListener("click", (e) => {
    if (e.target.tagName === "LI") {
      dropdownBtn.textContent = e.target.dataset.value;
      dropdownOptions.style.display = "none";
      renderNotes();
    }
  });

  document.addEventListener("click", (e) => {
    if (!e.target.closest(".custom-dropdown")) {
      dropdownOptions.style.display = "none";
    }
  });

  // Initial Render
  renderNotes();
  updateCounter();
});
