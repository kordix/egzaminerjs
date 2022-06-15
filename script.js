let tags = [];
let wordsall = [];
let words = [];
let errors = [];
let randomset = false;
let currentQuestion = {};
let currentQuestionIndex = 0;


let answer = '';

let settings = {
    sentences: 0,
    activelanguage: 'DE',
    currentcategory: 'wszystkie',
    counterset: 2
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
    // await axios.post("/public/api/read.php", { tabela: 'tags' }).then((res) => (tags = res.data));
    //  await axios.post("/public/api/read.php", { tabela: 'settings', id:1 }).then((res) =>{settings = res.data[0]; });
    await axios.post('/public/api/all.php', { tabela: 'questions' }).then((res) => { wordsall = res.data });
}

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

function start(){
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
}

function runWord() {
    document.getElementById('komunikaty').innerHTML = '&nbsp';
    document.getElementById('currentquestionquestion').innerHTML = currentQuestion.question;
    document.getElementById('currentquestioncounter').innerHTML = currentQuestion.counter;
    document.getElementById('currentquestionid').innerHTML = currentQuestion.id;
}

function next(){
    document.getElementById('answerinput').value = '';
    currentQuestionIndex++;
    if(currentQuestionIndex >= words.length){
        currentQuestionIndex = 0;
    }
    currentQuestion = words[currentQuestionIndex];
    runWord();
}

function handleLanguageSelect(event) {
    settings.activelanguage = event.value;
}

function handleAnswer(event) {

    answer = document.getElementById('answerinput').value;

    if (currentQuestion.rodzajnik && 1 == 0) {
        if (
            answer.escapeDiacritics().toLowerCase() ==
            currentQuestion.rodzajnik +
            " " +
            currentQuestion.answer.escapeDiacritics().toLowerCase() &&
            answer != ""
        ) {
            answerPositive();
        } else {
            answerNegative();
        }
    } else {
        if (
            answer.escapeDiacritics().toLowerCase() ==
            currentQuestion.answer.escapeDiacritics().toLowerCase()
        ) {
            answerPositive();
        } else {
            answerNegative();
        }
    }

}

function answerPositive(){
    document.getElementById('komunikaty').innerHTML = `<b>${currentQuestion.answer}</b> - prawidłowa odpowiedź`;


}

function answerNegative(){
    console.log();

    document.getElementById('komunikaty').innerHTML = `ŹLE! PRAWIDŁOWA ODPOWIEDŹ - <b>${currentQuestion.answer}</b>`;

}


loadData().then((res) => {
    getWords();
    start();
});



