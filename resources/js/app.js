/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('data-table', require('./components/smslist.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
Vue.filter('timeString', function (value) {
    return moment(value).format('YYYY-MM-DD HH:mm:ss');
  });

const myapptable = new Vue({
    el: '#myapptable',
    data() {
    	return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dataA:null,
            dataB:null,
            tablecode:0,
            sms_date:'',
            dev_name:'',
            dev_businesses:'',
            dev_number:'',
            send_number:'',
            sms_content:'',
            noticode:'',
            sms_keyword:'',
            stop:true,
            pagenum:50,
            nowpage:1,


        }
    },
    computed: {
        pagefirst:function(){
            try{
                return 1+(this.nowpage-1)*this.pagenum;
             }catch{

             }
             return 1;

        },
        pagelast:function(){
            try{
                if(this.nowpage != this.totalpage){
                    return this.nowpage*this.pagenum;
                }
                return this.pagelen;

             }catch{

             }
             return this.pagenum;

        },
        pagelen:function(){
            try{
                return Object.keys(this.dataA).length;

             }catch{

             }
             return;

        },
        alllen:function(){
            try{
                return Object.keys(this.dataB).length;

             }catch{

             }
             return;

        },
        totalpage:function(){
            try{
                let ddd =parseInt(this.pagelen/this.pagenum)+1;
                console.log(ddd);
                if(ddd){
                    return ddd;
                }
            }catch{

            }
            return 5;

        },
        showfield:function(){
            let a =this.pagelen;
            let b =this.pagenum;
            let c =this.nowpage;
            try{
            if(a < b){
                return this.dataA;
            }
            let data= this.dataA.filter(function (index,val) {
                if(val<c*b && val>= (c-1)*b ){
                    return true;
                }
            });
            return data;
            }catch{}
        },
    },
    methods:{
        nowpagenext(){
            if(this.nowpage!=this.totalpage){
                this.nowpage++;
            }
        },
        nowpagepre(){
            if(this.nowpage!=1){
                this.nowpage--;
            }
        },
        lastmonth(){
            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let date = new Date();
                date.setDate(1);
                date.setMonth(date.getMonth() - 1);
                date=date.toISOString().split('T')[0].split('-')[1];

                let table = v.sms_sendtime.split('T')[0].split('-')[1];
                return table==date;
                } );
                this.dataA=data;


        },
        thismonth(){
            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let date = new Date();
                date.setDate(1);
                date=date.toISOString().split('T')[0].split('-')[1];

                let table = v.sms_sendtime.split('T')[0].split('-')[1];
                return table==date;
                } );
                this.dataA=data;
        },
        before_yesterday(){
            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let date = new Date();
                date.setDate(date.getDate() - 2);
                date=date.toISOString().split('T')[0];
                let table = v.sms_sendtime.split('T')[0];
                return table==date;
                } );
                this.dataA=data;
        },
        date_yesterday(){
            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let date = new Date();
                date.setDate(date.getDate() - 1);
                date=date.toISOString().split('T')[0];
                let table = v.sms_sendtime.split('T')[0];
                return table==date;
                } );
                this.dataA=data;
        },
        date_today(){
            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let date = new Date();
                date=date.toISOString().split('T')[0];
                let table = v.sms_sendtime.split('T')[0];
                return table==date;
                } );
                this.dataA=data;
        },
        deletesms(a){
            let csrfToken = document.head.querySelector('meta[name="csrf-token"]');
            if (confirm("是否真的要刪除簡訊?\n ＊並不會實際刪除手機的簡訊，\n　　但後台不會再看到此簡訊")){
            $.ajax({
                headers: {
                                'X-CSRF-TOKEN': csrfToken.content
                            },
                type:"post",
                method: 'DELETE',
                url: `/sms-lists/${a.smsid}/delete`,
                data:{

                },
                }).done(function(msg){
                    alert('刪除成功')
                    myapptable.dataA.splice(myapptable.dataA.indexOf(a),1);
                }).fail(function(message){
                    alert(`權限不足`);
                });
            }else {
            }
        },
        date_clear(){
            this.sms_date='';
            this.dataA=this.dataB;
            this.allsearch();
        },
        all_clear(){
            this.dev_name='';
            this.dev_businesses='';
            this.dev_number='';
            this.send_number='';
            this.sms_content='';
            this.noticode='';
            this.sms_keyword='';
            this.dataA=this.dataB;
            this.allsearch();
        },
        allsearch(){
            let dataO=[this.dev_name,this.dev_businesses,this.dev_number,this.send_number,this.sms_content,this.noticode,this.sms_keyword,this.sms_date];
            let check =dataO[0].length+dataO[1].length+dataO[2].length+dataO[3].length+dataO[4].length+dataO[5].length+dataO[6].length+dataO[7].length
            if(check<1){
                return
            }
            console.log(dataO);

            this.dataA=this.dataB;
            let data=this.dataA.filter(function (v) {
                let dataM=[v.device.name,v.device.businesses,v.device.number+'', v.send_number+'',v.sms_content,v.noticode+'',v.keyword,v.sms_sendtime];
                for(let i=0;i<8;i++){
                    if((dataO[i]!=''&&dataM[i]!=null)&&dataM[i].includes(dataO[i])){
                        return true;
                    }
                }
                return false;
            });
            this.dataA=data;
        },
        switch_stop(){
            if(this.stop){
                this.stop=false;
            }else{
                this.stop=true;
            }
        },
        refresh(){
            setTimeout(() => {
            	this.refresh();
            },7000);
            if(this.stop){
                var that=this;
                try {
                    const a =this.dataB[0].smsid;

                    let csrfToken = document.head.querySelector('meta[name="csrf-token"]');
                    $.ajax({
                        headers: {
                                        'X-CSRF-TOKEN': csrfToken.content
                                    },
                        type:"post",
                        url:"/sms-lists3",
                        data:{
                            id:a,
                        },
                        success:function(data){
                            if(data==''){
                            }else{
                                data.forEach(element => {
                                    that.dataB.unshift(element);
                                });

                            }



                        }
                    })
                }
                catch(err) {
                }
            }
        },
    },
    created () {
        console.log('created');
      },
    beforeMount () {
        console.log('beforeMount');
    },
    mounted(){
        console.log('mounted');
        this.$nextTick(()=>{
            var that=this;
            let csrfToken = document.head.querySelector('meta[name="csrf-token"]');

            $.ajax({
                headers: {
                                'X-CSRF-TOKEN': csrfToken.content
                            },
                type:"post",
                url:"/sms-lists2",
                data:{},
                success:function(data){
                    that.dataA=data;
                    that.dataB=data;
                }
            })
        });
    },
    created () {
        console.log('created');
    },
    beforeUpdate () {
        console.log('beforeUpdate');
    },
    updated (){
        console.log('updated');
    },

});
setTimeout(myapptable.refresh(),7000);


