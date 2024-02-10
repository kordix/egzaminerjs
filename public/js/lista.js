let settings = {};
let wordsall = [];
let words = [];
let filtered = [];
let crudadd = {};
let editedid = 0;
let sortKey = '';
let newSortKey = '';
let order = 1;




async function loadData() {
    let self = this;
    await fetch('/api/settings.php', { method: 'POST', body: JSON.stringify({ tabela: 'settings' }) }).then(res => res.json()).then((res) => settings = res[0])
    await fetch('/api/all.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions' }) }).then(res => res.json()).then((res) => wordsall = res);


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

    if (settings.sentences === '1') {
        document.querySelector('#sentencecheckbox').checked = true;
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
    filtruj();
    document.querySelector('#tablebody').innerHTML = '';
    for (let i = 0; i < filtered.length; i++) {
        let elem = filtered[i];

        document.querySelector('#tablebody').innerHTML += `<td>${elem.id}</td> 
        <td>${elem.question}</td> 
        <td class="answers">${elem.answer}  <i class="bi bi-volume-up" style="cursor:pointer" class="speak" onclick="speak(${i})"></i></td> 
        <td>${elem.counter}</td> 
        <td><button class="btn btn-danger" id="deletebutton${elem.id}" onclick="deleteTheQuestion(${elem.id})">Usuń</button></td>
        <td><button class="btn btn-warning" id="editbutton${elem.id}" onclick="editTheQuestion(${elem.id})">Edytuj</button></td>
        `
    }
}

function filtruj() {
    let self = this;
    var filterkeydump = document.querySelector('#search').value;
    var filterKey = filterkeydump && filterkeydump.toLowerCase()
    var heroes = words;
    filtered = words;

    if (filterKey) {
        heroes = heroes.filter(function (row) {
            return Object.keys(row).some(function (key) {
                return String(row[key]).toLowerCase().indexOf(filterKey) > -1
            })
        })

    }
    if (sortKey) {
        heroes = heroes.slice().sort(function (a, b) {
            a = a[sortKey].toLowerCase()
            b = b[sortKey].toLowerCase()
            return (a === b ? 0 : a > b ? 1 : -1) * order
        })
    }

    filtered = heroes;
    newSortKey = sortKey;

}

function sortuj(sortkey) {
    if (newSortKey == sortKey) {
        order = !order;
    }

    if (newSortKey == '') {
        order = 1;
    }

    event.target.parentNode.classList = [];
    if (order == 1) {
        event.target.parentNode.classList.add('asc')
    }
    if (order == 0) {
        event.target.parentNode.classList.add('desc')
    }


    sortKey = sortkey;
    loadList();

}





function deleteTheQuestion(id) {
    let cruddata = { tabela: 'questions', id: id }
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
    if (document.getElementById('sentencecheckbox').checked) {
        sentence = 1;
    }

    let crudadd = {
        language: settings.activelanguage,
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
    let elem = words.find(el => el.id == id);

    document.querySelector('#questioninput').value = elem.question;
    document.querySelector('#crudanswerinput').value = elem.answer;
    document.querySelector('#addheader').innerHTML = 'Edytuj pytanie';
    document.querySelector('#savebutton').style.display = 'none';
    document.querySelector('#updatebutton').style.display = 'inline-block';

    editedid = id;


}

function updateTheQuestion(id) {
    let elem = words.find(el => el.id == id);
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

function toggleAnswers() {

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


function speak(i) {
    speech.text = wordsall[i].answer;
    window.speechSynthesis.speak(speech);

}
