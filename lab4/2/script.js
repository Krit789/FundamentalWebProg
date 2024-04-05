let lang = "th";
const label = {
  th: ["ชื่อ", "นามสกุล", 'ประเทศ' ,"เปลี่ยนเป็นภาษาอังกฤษ"],
  en: ["Name", "Surname", 'Country',"Switch to Thai"],
};
const countries = {
  th: [
    "เลือกประเทศ",
    "ไทย",
    "เวียดนาม",
    "ลาว",
    "มาเลย์เซีย",
    "สิงคโปร์",
    "ฟิลิปปินส์",
    "เมียนมาร์",
    "กัมพูชา",
    "บรูไน",
    "อินโดนีเซีย",
  ],
  en: [
    "Select a Country",
    "Thailand",
    "Vietnam",
    "Laos",
    "Malaysia",
    "Singapore",
    "Philippines",
    "Myanmar",
    "Cambodia",
    "Brunei",
    "Indonesia",
  ],
};

const elem = ["name", "surname", "country"];

document.getElementById("switchLang").addEventListener("click", () => {
  switchLang();
});

function switchLang() {
  elem.forEach(elemName => {
    const myElem = document.getElementById(elemName);
    myElem.children[0].remove();
  })
  const select = document.getElementById("selectInput");
  document.getElementById("switchLang").remove()

  const selectChildNum = select.children.length;
  for (let i = 0; i < selectChildNum; i++) {
    select.removeChild(select.children[select.children.length - 1]);
  }
  lang = lang === "th" ? "en" : "th"

  elem.forEach((elemName, indx) => {
    const elemParentDiv = document.getElementById(elemName);
    const elemLabel = document.createElement("label");
    elemLabel.appendChild(document.createTextNode(label[lang][indx]));
    elemLabel.setAttribute("id", `${elemName}Input`);
    elemLabel.setAttribute("for", `${elemName}Input`);
    elemParentDiv.insertBefore(elemLabel, elemParentDiv.children[0]);
  })

  const selectElem = document.getElementById("selectInput");
  countries[lang].forEach((val, indx) => {
    const optionElem = document.createElement("option");
    const optionText = document.createTextNode(val);
    optionElem.appendChild(optionText);
    optionElem.setAttribute("value", indx);
    if (!indx) {
      optionElem.setAttribute("disabled", "");
      optionElem.setAttribute("selected", "selected");
    }
    selectElem.appendChild(optionElem);
  });

  const switchLangBtn = document.createElement("button");
  switchLangBtn.setAttribute("id", "switchLang");
  switchLangBtn.setAttribute("type", "submit");
  switchLangBtn.setAttribute("class", "btn btn-primary");
  switchLangBtn.appendChild(document.createTextNode(label[lang][3]));
  switchLangBtn.addEventListener("click", () => {
    switchLang();
  });
  document.getElementsByTagName('main')[0].appendChild(switchLangBtn);
}
