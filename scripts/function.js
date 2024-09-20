function validateForm() {
  var title = document.getElementById('title').value;
  var date = document.getElementById('date').value;

  if (title.trim() === '') {
    alert('O título é obrigatório.');
    return false;
  }

  if (date.trim() === '') {
    alert('A data é obrigatória.');
    return false;

  }
}