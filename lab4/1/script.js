document.getElementById('calculate-btn').addEventListener("click", () => { addVal() });

const result = document.createElement('p')
result.setAttribute('id', 'resultShow')
result.appendChild(document.createTextNode('Result: '))
document.getElementById('result').appendChild(result)

function addVal() {
    const val1 = Number(document.getElementById('val1').value)
    const val2 = Number(document.getElementById('val2').value)
    if (val1 && val2) {
        document.getElementById('resultShow').innerText = `Result: ${val1 + val2}`

        const hist = document.createElement('p')
        hist.appendChild(document.createTextNode(`${val1} + ${val2} = ${val1 + val2}`))

        const result_hist = document.getElementById('result-hist')
        result_hist.appendChild(hist)
        result_hist.scrollTop = result_hist.scrollHeight;
    }
}