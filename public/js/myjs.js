document.addEventListener('DOMContentLoaded', function() {
  reduceDesc();
});

function reduceDesc() {
  desc = document.querySelectorAll('.desc');
    desc.forEach(element=> {
        var aux = "";
        var s = element.innerHTML;
        var i = 0;
        if (s.length < 30) {
            aux+=s;
        } else {
            for (i = 0; i < 30; i++) {
                aux+= s[i];
            }
        }
        aux += '...';
        element.innerHTML = aux;
    });
}

function loadFile(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
}


function sortTable(num) {
    const btns = document.querySelectorAll('.sort');
    btns.forEach(element => {
        element.innerHTML = "^"
    });
    btn = document.getElementById(num);
    btn.innerHTML = "v"
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[num];
        y = rows[i + 1].getElementsByTagName("TD")[num];
        // Check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }

function showImage(element) {
  var modal = document.getElementById("myModal");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  modal.style.display = "block";
  modalImg.src = element.src;
  captionText.innerHTML = element.alt;
  var span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
}

const showImg = element => {
  var modal = document.getElementById("myModal");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = element.dataset.img;
    captionText.innerHTML = `<h1>${element.dataset.by}</h1>`;
  var span = document.getElementsByClassName("close2")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
}