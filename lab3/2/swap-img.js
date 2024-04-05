let myGrid = [document.getElementById("grid-1").innerHTML, document.getElementById("grid-2").innerHTML, document.getElementById("grid-3").innerHTML, document.getElementById("grid-4").innerHTML];

function swapImage() {
  let tmp = [...myGrid]
  myGrid[0] = tmp[2]
  myGrid[1] = tmp[0]
  myGrid[3] = tmp[1]
  myGrid[2] = tmp[3]
  document.getElementById("grid-1").innerHTML = myGrid[0];
  document.getElementById("grid-2").innerHTML = myGrid[1];
  document.getElementById("grid-3").innerHTML = myGrid[2];
  document.getElementById("grid-4").innerHTML = myGrid[3];
}
