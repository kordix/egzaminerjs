

function add(){
    console.log('fasdfdadffsd');
    var partofspeechselect = document.getElementById('partofspeechselect');
    var partofspeechselectvalue = partofspeechselect.options[partofspeechselect.selectedIndex].value;


    let crudadd = {
        sentence: document.getElementById('sentencecheckbox').checked ? 1 : 0,
        question: document.getElementById('questioninput').value,
        answer: document.getElementById('answerinput').value ,
        rodzajnik:'', 
        tags:'nieprzypisane',
        partofspeech:partofspeechselectvalue
    }

    fetch('/api/add.php',{method:'POST',body:JSON.stringify({tabela:'questions',dane:crudadd}) }).then((res)=>console.log('poszło'))
    document.getElementById('messages').innerHTML = `Dodano pytanie ${crudadd.question}`;

}

function handleRodzajnikSelect(event){
    crudadd.rodzajnik = event.value;
}

