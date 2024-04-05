document.getElementById("regis-btn").addEventListener("click", () => {
  makeRegistration();
});

document.getElementById("u_id").addEventListener("keyup", () => {
  validateInput();
});

document.getElementById("u_name").addEventListener("keyup", () => {
  validateInput();
});
document.getElementById("u_surname").addEventListener("keyup", () => {
  validateInput();
});
function validateInput() {
  const myData = [
    document.getElementById("u_id").value,
    document.getElementById("u_name").value,
    document.getElementById("u_surname").value,
  ];
  if (!(myData[0] && !isNaN(myData[0]) && myData[1] && myData[2])) {
    document.getElementById("regis-btn").setAttribute("disabled", "");
    document.getElementById("alert").innerHTML =
      '<div class="alert alert-danger" role="alert">กรุณากรอกข้อมูลให้ครบ</div>';
  } else {
    if (!(isNaN(myData[1]) && isNaN(myData[2]))) {
      document.getElementById("regis-btn").setAttribute("disabled", "");
      document.getElementById("alert").innerHTML =
        '<div class="alert alert-danger" role="alert">ชื่อ-นามสกุล ต้องเป็นตัวอักศรเท่านั้น</div>';
    } else {
      document.getElementById("regis-btn").removeAttribute("disabled");
      document.getElementById("alert").innerHTML = "";
    }
  }
}

function makeRegistration() {
  const tbody = document.getElementById("myTbody");
  const myData = [
    document.getElementById("u_id").value,
    document.getElementById("u_name").value,
    document.getElementById("u_surname").value,
  ];

  if (
    !(
      !isNaN(myData[0]) &&
      myData[1] &&
      myData[2] &&
      isNaN(myData[1]) &&
      isNaN(myData[2])
    )
  ) {
    alert("Invalid Input");
    return;
  }

  if (tbody.children[0].getAttribute("id") === "initial-state") {
    tbody.children[0].remove();
  }

  let t_row = document.createElement("tr");
  let t_data = document.createElement("td");
  t_data.appendChild(document.createTextNode(tbody.childElementCount + 1));
  t_row.appendChild(t_data);

  t_row.appendChild(t_data);
  myData.forEach((element) => {
    t_data = document.createElement("td");
    t_data.appendChild(document.createTextNode(element));
    t_row.appendChild(t_data);
  });

  document.getElementById("u_id").value = null;
  document.getElementById("u_name").value = null;
  document.getElementById("u_surname").value = null;
  document.getElementById("regis-btn").setAttribute("disabled", "");
  tbody.appendChild(t_row);
}
