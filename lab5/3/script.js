let correct_answers;
let correct_count;

async function fetchData() {
    correct_answers = [];
    correct_count = 0;
    document.getElementsByClassName('container')[0].innerHTML = `<h1>WWII Quiz 1</h1><p id="status"></p>`

    document.getElementById('status').innerHTML = "Fetching Data..."
    await fetch('http://10.0.15.21/lab/lab5/questionAnswerData.json').then(async res => {
        let data = await res.json()
        document.getElementById('status').remove()
        data.forEach((element, indx) => {
            const answers = element.answers;
            const questionDiv = document.createElement('div')
            const choiceSel = document.createElement('div')
            questionDiv.className = 'row mb-3';
            questionDiv.setAttribute('id', `Q-${indx}`)
            choiceSel.style.display = 'flex'
            choiceSel.style.flexDirection = 'column'
            choiceSel.style.marginLeft = '16px'
            const question = document.createElement('p')
            question.style.margin = '0'
            question.innerHTML = `<strong>${indx + 1}.) ${element.question}</strong>`

            for (const key in answers) {
                if (answers.hasOwnProperty(key)) {
                    if (key === 'correct') {
                        correct_answers.push(answers[key])
                        continue;
                    };
                    const choiceDiv = document.createElement('div')
                    const choices = document.createElement('input');
                    const choicesLabel = document.createElement('label');
                    choices.setAttribute('id', `Q${indx}-${key.toUpperCase()}`)
                    choiceDiv.className = "form-check"
                    choices.className = 'form-check-input'
                    choices.setAttribute('type', 'radio')
                    choices.setAttribute('value', `${key}`)
                    choices.setAttribute('name', `Q${indx}`)
                    choicesLabel.innerHTML = `<b>${key.toUpperCase()}.)</b> ${answers[key]}`
                    choicesLabel.className = 'form-check-label';
                    choicesLabel.setAttribute('for', `Q${indx}-${key.toUpperCase()}`)
                    choicesLabel.setAttribute('id', `Q${indx}-${key.toUpperCase()}-L`)

                    choiceDiv.appendChild(choices);
                    choiceDiv.appendChild(choicesLabel);
                    choiceSel.appendChild(choiceDiv)
                }
            }
            questionDiv.appendChild(question)
            questionDiv.appendChild(choiceSel)
            document.getElementsByClassName('container')[0].appendChild(questionDiv)
        });
        document.getElementsByClassName('container')[0].innerHTML += '<button class="btn btn-primary" id="submit-btn" onclick="checkAnswer()" data-mdb-ripple-init >Submit</button>'
    })
}

function checkAnswer(){
    for (let i = 0; i < correct_answers.length; i++) {
        const all_choice = document.getElementsByName(`Q${i}`)
        for (let j = 0; j < all_choice.length; j++) {
            if (all_choice[j].checked) {
                if (correct_answers[i] === all_choice[j].value){
                    correct_count++;
                    document.getElementById(`Q${i}-${all_choice[j].value.toUpperCase()}-L`).innerHTML += '&nbsp&nbsp<span class="badge rounded-pill badge-success">Correct</span>'
                } else {
                    document.getElementById(`Q${i}-${all_choice[j].value.toUpperCase()}-L`).innerHTML += '&nbsp&nbsp<span class="badge rounded-pill badge-danger">Incorrect</span>'
                }
                break;
            }
        }
    }
    document.getElementById('submit-btn').setAttribute('disabled', '')
    document.getElementsByClassName('container')[0].innerHTML += '<button class="btn btn-danger ml-5" onclick="fetchData()" data-mdb-ripple-init >Reset</button>'
    alert(`คุณทำถูก ${correct_count} ข้อ จาก ${correct_answers.length} ข้อ`)
}
fetchData()