let note = document.querySelectorAll('div.note');
//console.log(typeof(note));

for (let i = 0; i < note.length; i++) {
    note[i].addEventListener('click', openNote);

  function openNote() {
    console.log(this.getAttribute("id"));
    
  }
}
