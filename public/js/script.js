let tags = [];
let wordsall = [];
let words = [];
let errors = [];
let randomset = false;
let currentQuestion = {};
let currentQuestionIndex = 0;
let crudadd = {};


let answer = '';

let settings = {
    sentences: 0,
    activelanguage: 'DE',
    currentcategory: 'wszystkie',
    counterset: 5
}

let siemano = 'fdsfdasdafsd';

String.prototype.escapeDiacritics = function () {
    return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
        .replace(/ć/g, 'c').replace(/Ć/g, 'C')
        .replace(/ę/g, 'e').replace(/Ę/g, 'E')
        .replace(/ł/g, 'l').replace(/Ł/g, 'L')
        .replace(/ń/g, 'n').replace(/Ń/g, 'N')
        .replace(/ó/g, 'o').replace(/Ó/g, 'O')
        .replace(/ś/g, 's').replace(/Ś/g, 'S')
        .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
        .replace(/ź/g, 'z').replace(/Ź/g, 'Z')
        .replace(/ü/g, 'u').replace(/ú/g, 'u')
        .replace(/ö/g, 'o').replace(/é/g, 'e')
        .replace(/ä/g, 'a').replace(/í/g, 'i')
        .replace(/á/g, 'a').replace(/ö/g, 'o')
        .replace(/ß/g, 'ss')
        .replace(/ñ/g, 'n')
        ;
}

async function loadData() {
    let self = this;
    // await axios.post("/api/read.php", { tabela: 'tags' }).then((res) => (tags = res.data));
    //  await axios.post("/api/read.php", { tabela: 'settings', id:1 }).then((res) =>{settings = res.data[0]; });
    // await axios.post('/api/all.php', { tabela: 'questions' }).then((res) => { wordsall = res.data });

    await fetch('/api/settings.php', { method: 'POST', body: JSON.stringify({ tabela: 'settings' }) }).then(res => res.json()).then((res) => settings = res[0])
    await fetch('/api/all.php', { method: 'POST', bfody: JSON.stringify({ tabela: 'questions' }) }).then(res => res.json()).then((res) => wordsall = res)

}

function getWords() {
    if (settings.sentences == 1) {
        settings.sentences = '1';
    }

    if(settings.random){
        wordsall = _.shuffle(wordsall);
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

function start() {
    if (this.randomset === 'true') {
        let count = this.words.length
        let num = Math.floor(Math.random() * count);
        currentQuestion = words[num];
        currentQuestionIndex = num;
    } else {
        currentQuestion = words[0];
        currentQuestionIndex = 0;
    }

    runWord();

    document.getElementById('counterinput').value = settings.counterset;

    if (settings.sentences == 1) {
        document.getElementById('senctencesselect').selectedIndex = 1;
    }

    if (settings.tryb == 'DEPOL') {
        document.getElementById('tryb').selectedIndex = 1;
    }

    document.querySelector('#answerinput').focus();

    if(settings.activelanguage != 'DE'){
        document.querySelector('#collinsy').style.visibility = 'hidden';
    }

    if(settings.random == 1){
        document.querySelector('#randomcheck').checked = true;
    }



}

function runWord() {
    if (document.getElementById('komunikaty')) {
        document.getElementById('komunikaty').innerHTML = '&nbsp';
    }else{
        return;
    }

    if (settings.tryb == 'POLDE') {
        document.getElementById('currentquestionquestion').innerHTML = currentQuestion.question;
    }

    if (settings.tryb == 'DEPOL') {
        document.getElementById('currentquestionquestion').innerHTML = currentQuestion.answer;
    }
    document.getElementById('currentquestioncounter').innerHTML = currentQuestion.counter;
    document.getElementById('currentquestionid').innerHTML = currentQuestion.id;
    document.getElementById('collinslink').href = `https://www.collinsdictionary.com/dictionary/german-english/${currentQuestion.answer.split(' / ')[0]}`;
    document.getElementById('wiktionarylink').href = `https://pl.wiktionary.org/wiki/${currentQuestion.answer.split(' / ')[0]}`;
    document.getElementById('bablalink').href = `https://pl.bab.la/slownik/niemiecki-polski/${currentQuestion.answer.split(' / ')[0]}`;




}

function next() {
    document.getElementById('answerinput').value = '';
    currentQuestionIndex++;
    if (currentQuestionIndex >= words.length) {
        location.reload();
        currentQuestionIndex = 0;
    }
    currentQuestion = words[currentQuestionIndex];
    runWord();
    document.querySelector('#answerinput').focus();
}

function deleteQuestion() {
    let cruddata = { tabela: 'questions', id: currentQuestion.id }
    fetch('/api/delete.php', { method: 'POST', body: JSON.stringify(cruddata) }).then((res) => console.log(res))
    console.log('delete');
    this.next();
}

function prev() {
    document.getElementById('answerinput').value = '';
    currentQuestionIndex--;
    if (currentQuestionIndex < 0) {
        currentQuestionIndex = words.length - 1;
    }
    currentQuestion = words[currentQuestionIndex];
    runWord();
}

function saveCounterset() {
    settings.counterset = document.getElementById('counterinput').value;
    saveSettings();
}

function handleLanguageSelect(event) {
    settings.activelanguage = event.value;
    saveSettings();
}

function saveSettings() {
    if (settings.random){
        settings.random = 1
    }else{
        settings.random = 0
    }
    var senctencesselect = document.getElementById('senctencesselect');
    var senctencesselectvalue = senctencesselect.options[senctencesselect.selectedIndex].value;

    settings.sentences = senctencesselectvalue;
    let cruddata = { tabela: 'settings', dane: settings }
    fetch('/api/savesettings.php', { method: 'POST', body: JSON.stringify(cruddata) }).then((res) => console.log(res))
    location.reload()
}

function handleAnswer(event) {

    answer = document.getElementById('answerinput').value;
    let answers = currentQuestion.answer.split(' / ');
    if (settings.tryb == 'DEPOL') {
        answers = currentQuestion.question.split(' / ');
    }
    let passed = 0;


    for (let i = 0; i < answers.length; i++) {
        let elem = answers[i];

        if (answer.escapeDiacritics().toLowerCase() == answers[i].escapeDiacritics().toLowerCase()) {
            passed = 1;
        }
    }


    if (passed) {
        answerPositive();
    } else {
        answerNegative();
    }

    document.getElementById('nextbutton').focus();


}

function answerPositive() {
    document.getElementById('komunikaty').innerHTML = `<b>${currentQuestion.rodzajnik} ${currentQuestion.answer}</b> - prawidłowa odpowiedź!`;
    if (settings.tryb == 'DEPOL') {
        document.getElementById('komunikaty').innerHTML = `<b>${currentQuestion.rodzajnik} ${currentQuestion.question}</b> - prawidłowa odpowiedź!`;
    }

    document.getElementById('currentquestioncounter').innerHTML = currentQuestion.counter;
    updatecounter(1);

}

function updatecounter(ile, nextt) {
    currentQuestion.counter += ile;
    if (ile == 0) {
        currentQuestion.counter = 0;
    }

    let bodypost = {
        counter: currentQuestion.counter,
        questionid: currentQuestion.id,
        userid: 1
    };
    fetch(`/api/updateresult.php`, { method: 'POST', body: JSON.stringify(bodypost) })

    if (nextt) {
        next();
    }
}

function answerNegative() {
    if (settings.tryb == 'POLDE') {
        document.getElementById('komunikaty').innerHTML = `ŹLE! PRAWIDŁOWA ODPOWIEDŹ - <b>${currentQuestion.rodzajnik} ${currentQuestion.answer}</b>`;
    }

    if (settings.tryb == 'DEPOL') {
        document.getElementById('komunikaty').innerHTML = `ŹLE! PRAWIDŁOWA ODPOWIEDŹ - <b>${currentQuestion.rodzajnik} ${currentQuestion.question}</b>`;
    }
}


function add() {
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

    fetch('/api/add.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions', dane: crudadd }) }).then((res) => console.log('poszło'))
    document.getElementById('messages').innerHTML = `Dodano pytanie ${crudadd.question}`;

}

function edytuj() {
    document.querySelector('#questioninput').value = currentQuestion.question;
    document.querySelector('#crudanswerinput').value = currentQuestion.answer;
    document.querySelector('#addheader').innerHTML = 'Edytuj pytanie';
    document.querySelector('#savebutton').style.display = 'none';
    document.querySelector('#updatebutton').style.display = 'inline-block';


}


function updateQuestion() {
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

    fetch('/api/update.php', { method: 'POST', body: JSON.stringify({ tabela: 'questions', dane: crudadd, id: currentQuestion.id }) }).then((res) => console.log('poszło'))
    document.getElementById('messages').innerHTML = `Zedytowano pytanie ${crudadd.question}`;


}

function handleRodzajnikSelect(event) {
    crudadd.rodzajnik = event.value;
}




loadData().then((res) => {
    getWords();
    start();
    document.getElementById('languageinput').value = settings.activelanguage;


});

if (document.querySelector('#answerinput')) {
    document.querySelector('#answerinput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            document.querySelector('#answerbutton').click()
        }
    });
}



let speech = new SpeechSynthesisUtterance();

let voices = [];
window.speechSynthesis.onvoiceschanged = () => {
  voices = window.speechSynthesis.getVoices();
  speech.voice = voices[16];
};

document.querySelector("#speak").addEventListener("click", () => {
    speech.text = currentQuestion.answer;
    // speech.text = 'бежать';
    window.speechSynthesis.speak(speech);
  });

