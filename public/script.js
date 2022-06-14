window.events = new Vue();
//
window.next = function () {
    window.events.$emit('next');
};


let app = new Vue({
    data: {
        wylogujshow: false,
        errors: [],
        wordsall: [],
        words: [],
        tags: [],
        chosentag: {},
        activeobszar: 'egzaminer',
        activeobszar2: 'egzaminer',
        sentences:0,

        settings: {
        },
        randomset: 'false',
        randomset2: false,
        currentQuestion: { "id": 356, "question": "sondaże", "answer": "Umfragewerte", "language": "DE", "partofspeech": "nieprzypisane", "tags": "nieprzypisane", "rodzajnik": "", "fav": "", "level": "", "created_at": "2021-06-13 11:54:40", "updated_at": "2021-06-26 05:52:19", "question_id": 356, "user_id": 1, "counter": 1 }
    },
    el: '#app',
    created() {
        let self = this;
        this.loadData();
    },
    methods: {
        async setLanguage(lang) {
            this.activelanguage = lang;
            let self = this;
            await axios.patch('/api/update.php', { tabela:'settings', dane:{activelanguage:lang}, id:1 }).then((res) => location.reload());
        },
        async loadData() {
            let self = this;
            await axios.post("api/read.php", { tabela: 'tags' }).then((res) => (self.tags = res.data));

            
            await axios.post("api/read.php", { tabela: 'settings', id:1 }).then((res) =>{self.settings = res.data[0];console.log(1) });


            await axios.post('/api/all.php', { tabela: 'questions' }).then((res) => {self.wordsall = res.data;console.log(2)  }).then((res) => self.getWords()).then((res) => self.getWord());

        },
        getWords(state, data) {
            let self = this;
            console.log('sentences',self.sentences,typeof(self.sentences) );

            if (self.sentences == 1){
                self.sentences = '1';
            }
            
            this.wordsall = this.wordsall.filter((el) => el.language == self.$root.settings.activelanguage);

            this.words = this.wordsall.filter((el)=>el.sentence == self.sentences);

            console.log(self.settings.activelanguage);
            console.log(this.words);
            this.words = this.words.filter((el) => el.counter < self.settings.counterset);
            if (this.words.length < 1) { console.log('skończyły się słówka'); self.errors.push('Skończyły się słówka - zmień counter, kategorię albo dodaj nowe'); return };

            if (this.settings.currentcategory) {
                if(this.settings.currentcategory != 'wszystkie'){
                    this.words = this.words.filter((el) => el.partofspeech == self.settings.currentcategory)
                }
            }

            if (this.settings.currenttag) {
                this.words = this.words.filter((el) => el.tags == self.settings.currenttag)
            }

        },
        
        getZdania(){
            this.$root.sentences = 1;
            this.getWords();
            this.getWord();
        },
        getWord() {
            if (this.randomset === 'true') {
                let count = this.words.length
                let num = Math.floor(Math.random() * count);
                console.log(num);

                this.currentQuestion = this.words[num];
            } else {
                this.currentQuestion = this.words[0];
            }
        },


    }
})