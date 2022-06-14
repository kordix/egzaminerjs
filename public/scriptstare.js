Vue.component('read', {
    data() {
        return {
            heads: [],
            cruddata: [],
            search:'',
            sortkey:''
        }
    },
    created() {
        let self = this;
        axios.get('api/read.php').then((res) => {this.cruddata = res.data}).then((res) => self.getHeads());
    },
    methods: {
        edit(id) {
            this.$emit('editevent', id);
        },
        deletem(id) {
            axios.post('api/delete.php', { id: id }).then((res) => console.log(res)).then((res) => location.reload());
        },
        getHeads(){
            if(this.cruddata[0]){
                this.heads = Object.keys(this.cruddata[0])
            }
        },
        sortBy(elem){
            console.log('sortby');
            this.sortkey=elem;
        }
    },
    computed:{
        filtered: function () {
            let self = this;
            var filterKey = this.search && this.search.toLowerCase()
            var order = 1;
            var filtered = this.cruddata;
            if (filterKey) {
                filtered = filtered.filter(function (row) {
                return Object.keys(row).some(function (key) {
                  return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                })
              })
            }
            if (this.sortkey) {
                
                filtered = filtered.sort(function (a, b) {
                    console.log(self.sortkey);
                    
                    var keyA =a[self.sortkey];
                    var keyB = b[self.sortkey];
                // Compare the 2 dates
                if(keyA < keyB) return -1;
                if(keyA > keyB) return 1;
                return 0;
              })
            }
            return filtered
          }
    }
});

Vue.component('edit', {
    props: ['id', 'mode'],
    data() {
        return {
            cruddata: {},
            editid: null,
            action: 'api/add.php',
            editid:null,
        }
      },
    watch: {
        id() {
            this.getData();
        },
        mode(val) {
            if (val == 'edit') {
                this.action = 'api/update.php'
            } else {
                this.action = 'api/add.php'
            }
        }
    },
    created() {
        if (this.mode == 'edit') {
            this.getData();
        } else {
            // this.cruddata={};
        }
    },
    methods: {
        getData() {
            let self = this;
            axios.get('api/readone.php?id=' + self.id).then((res) => self.cruddata = res.data)
        }
       
    }
});


let app = new Vue({
    el: '#app',
    data: {
        //REPLACE
        dane: [{"nazwa":"kod","typ":"varchar(180)"},{"nazwa":"opis","typ":"varchar(180)"}],
    editid:null,
    mode:'create'
        
    },
    methods:{
        edit(id){
            this.editid = id;
            this.mode='edit';
        }
    }
})