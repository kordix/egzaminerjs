let settings = {};
let wordsall = [];
let words = [];
let crudadd = {};
let editedid = 0;




async function loadData() {
    let self = this;
    await fetch('/api/settings.php', { method: 'POST', body: JSON.stringify({ tabela: 'settings' }) }).then(res => res.json()).then((res) => settings = res[0])
    await fetch('/api/all.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions' }) }).then(res => res.json()).then((res) => wordsall = res)
}

loadData().then((res) => {
    getWords();
    loadList();
    document.getElementById('languageinput').value = settings.activelanguage;
});


function getWords() {
    if (settings.sentences == 1) {
        settings.sentences = '1';
    }

    wordsall = wordsall.filter((el) => el.language == settings.activelanguage);

    words = wordsall.filter((el) => el.sentence == settings.sentences);
    words = words.filter((el) => el.counter < settings.counterset);
    if (words.length < 1) { console.log('skończyły się słówka'); errors.push('Skończyły się słówka - zmień counter, kategorię albo dodaj nowe'); return };

    if (settings.currentcategory) {
        if (settings.currentcategory != 'wszystkie') {
            words = words.filter((el) => el.partofspeech == self.settings.currentcategory);
        }
    }

    if (settings.currenttag) {
        words = this.words.filter((el) => el.tags == self.settings.currenttag);
    }

}

function loadList() {
    for (let i = 0; i < words.length; i++) {
        let elem = words[i];
        document.querySelector('#tablebody').innerHTML += `<td>${elem.id}</td> 
        <td>${elem.question}</td> 
        <td class="answers">${elem.answer}  <i class="bi bi-volume-up" style="cursor:pointer" class="speak" onclick="speak(${i})"></i></td> 
        <td>${elem.counter}</td> 
        <td><button class="btn btn-danger" id="deletebutton${elem.id}" onclick="deleteTheQuestion(${elem.id})">Usuń</button></td>
        <td><button class="btn btn-warning" id="editbutton${elem.id}" onclick="editTheQuestion(${elem.id})">Edytuj</button></td>
        `
    }

    const dataTable = new simpleDatatables.DataTable("#myTable", {
        searchable: true,
        fixedHeight: true,
        perPage: 1000,
        paging: false
    })
}

function deleteTheQuestion(id) {
    let cruddata = { tabela: 'questions', id: id}
    fetch('/api/delete.php', { method: 'POST', body: JSON.stringify(cruddata) }).then((res) => console.log(res))
    location.reload();
}

function handleRodzajnikSelect(event) {
    crudadd.rodzajnik = event.value;
}


function add() {
    document.querySelector('#updatebutton').style.display = 'none';
    document.querySelector('#savebutton').style.display = 'inline-block';
    
    var partofspeechselect = document.getElementById('partofspeechselect');
    var partofspeechselectvalue = partofspeechselect.options[partofspeechselect.selectedIndex].value;

    let sentence = 0;
    if (parseInt(document.getElementById('sentencecheckbox').checked == 1)) {
        sentence = 1;
    }

    let crudadd = {
        language:settings.activelanguage,
        sentence: sentence,
        question: document.getElementById('questioninput').value,
        answer: document.getElementById('crudanswerinput').value,
        rodzajnik: '',
        tags: 'nieprzypisane',
        partofspeech: partofspeechselectvalue
    }

    fetch('/api/add.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions', dane: crudadd }) }).then((res) => location.reload())
    document.getElementById('messages').innerHTML = `Dodano pytanie ${crudadd.question}`;

}

function editTheQuestion(id) {
    let elem = words.find(el=>el.id == id);

    document.querySelector('#questioninput').value = elem.question;
    document.querySelector('#crudanswerinput').value = elem.answer;
    document.querySelector('#addheader').innerHTML = 'Edytuj pytanie';
    document.querySelector('#savebutton').style.display = 'none';
    document.querySelector('#updatebutton').style.display = 'inline-block';

    editedid = id;


}

function updateTheQuestion(id) {
    let elem = words.find(el=>el.id == id);
    var partofspeechselect = document.getElementById('partofspeechselect');
    var partofspeechselectvalue = partofspeechselect.options[partofspeechselect.selectedIndex].value;

    let sentence = 0;
    if (parseInt(document.getElementById('sentencecheckbox').checked == 1)) {
        sentence = 1;
    }

    let crudadd = {
        sentence: sentence,
        question: document.getElementById('questioninput').value,
        answer: document.getElementById('crudanswerinput').value,
        rodzajnik: '',
        tags: 'nieprzypisane',
        partofspeech: partofspeechselectvalue
    }

    fetch('/api/update.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions', dane: crudadd, id: editedid }) }).then((res) => location.reload())
    document.getElementById('messages').innerHTML = `Zedytowano pytanie ${crudadd.question}`;
}


function handleLanguageSelect(event) {
    settings.activelanguage = event.value;
    saveSettings();
}

function toggleAnswers(){

    Array.from(document.getElementsByClassName('answers')).forEach(element => {
            element.classList.toggle('hide');
    });
}

let speech = new SpeechSynthesisUtterance();

let voices = [];
window.speechSynthesis.onvoiceschanged = () => {
  voices = window.speechSynthesis.getVoices();
  speech.voice = voices[16];
};


function speak(i){
    speech.text =  wordsall[i].answer;
    window.speechSynthesis.speak(speech);

}