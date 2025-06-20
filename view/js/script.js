function myFunction() {
  var x = document.getElementById("liens");
  if (x.classList.contains('show')) {
    x.classList.remove('show');
  } else {
    x.classList.add('show');
  }
}
