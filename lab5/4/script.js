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
    myAlert.innerHTML =
      "<ul><b>เกิดข้อผิดพลาดดังนี้ ข้อมูลของคุณไม่ถูกบันทึก</b>";
    errorData.forEach((element) => {
      myAlert.innerHTML += `<li>${element}</li>`;
    });
    myAlert.innerHTML += "</ul>";
  } else {
    myAlert.setAttribute("class", "alert alert-success");
    myAlert.innerHTML =
      "<b>ข้อมูลของคุณถูกต้อง เราได้บันทึกข้อมูลของคุณแล้ว<b>";
    localStorage.setItem(
      "userData",
      JSON.stringify({
        national_id: myForms.national_id.value,
        initials: myForms.initials.selectedIndex,
        first_name: myForms.first_name.value,
        last_name: myForms.last_name.value,
        address: myForms.address.value,
        subdistrict: myForms.subdistrict.value,
        district: myForms.district.value,
        province: myForms.province.selectedIndex,
        postal_code: myForms.postal_code.value,
      })
    );
  }
}

function loadFromLS() {
  let userData = localStorage.getItem("userData");
  if (!userData) {
    myAlert.setAttribute("class", "alert alert-danger");
    myAlert.innerHTML = "<b>คุณไม่เคยบันทึกข้อมูลของคุณในระบบ<b>";
    return;
  }
  userData = JSON.parse(userData);
  for (const key in userData) {
    if (userData.hasOwnProperty(key)) {
      if (key === "initials" || key === "province") {
        document.getElementById(key).options[userData[key]].selected = true;
      } else {
        document.getElementById(key).value = userData[key];
      }
    }
  }
  myAlert.setAttribute("class", "alert alert-success");
  myAlert.innerHTML = "<b>ข้อมูลของคุณถูกกู้คืนสำเร็จ<b>";
}
