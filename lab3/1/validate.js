function validateOnSubmit() {
  const myForms = document.forms["the-forms"];
  const myAlert = document.getElementById("myAlert");
  let errorData = [];

  if (
    myForms.national_id.value.length != 13 ||
    isNaN(myForms.national_id.value)
  ) {
    errorData.push("รหัสประจำตัวประชาชนไม่ถูกต้อง");
  }
  if (!myForms.initials.value || !isNaN(myForms.district.value)) {
    errorData.push("กรุณาใส่คำนำหน้าชื่อ");
  }

  if (
    !(
      myForms.first_name.value.length >= 2 &&
      myForms.first_name.value.length <= 20
    ) ||
    !isNaN(myForms.first_name.value)
  ) {
    errorData.push("กรุณาใส่ชื่อให้ถูกต้อง");
  }

  if (
    !(
      myForms.last_name.value.length >= 2 &&
      myForms.last_name.value.length <= 20
    ) ||
    !isNaN(myForms.last_name.value)
  ) {
    errorData.push("กรุณาใส่นามสกุลให้ถูกต้อง");
  }

  if (!myForms.address.value.length >= 15 || !isNaN(myForms.address.value)) {
    errorData.push("กรุณาใส่ที่อยู่ให้ถูกต้อง");
  }

  if (
    !myForms.subdistrict.value.length >= 2 ||
    !isNaN(myForms.subdistrict.value)
  ) {
    errorData.push("กรุณาใส่ตำบล/แขวงให้ถูกต้อง");
  }

  if (!myForms.district.value.length >= 2 || !isNaN(myForms.district.value)) {
    errorData.push("กรุณาใส่อำเภอ/เขตให้ถูกต้อง");
  }

  if (!myForms.province.value || !isNaN(myForms.district.value)) {
    errorData.push("กรุณาใส่จังหวัดให้ถูกต้อง");
  }

  if (
    myForms.postal_code.value.length !== 5 ||
    isNaN(myForms.postal_code.value)
  ) {
    errorData.push("กรุณาใส่รหัสไปรษณีย์ให้ถูกต้อง");
  }

  if (errorData.length) {
    myAlert.setAttribute("class", "alert alert-danger");
    myAlert.innerHTML = "<ul><b>เกิดข้อผิดพลาดดังนี้</b>";
    errorData.forEach((element) => {
      myAlert.innerHTML += `<li>${element}</li>`;
    });
    myAlert.innerHTML += "</ul>";
  } else {
    myAlert.setAttribute("class", "alert alert-success");
    myAlert.innerHTML = "<b>ยินดีด้วย ข้อมูลของคุณถูกต้อง<b>";
  }

}
