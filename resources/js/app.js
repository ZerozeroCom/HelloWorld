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
Vue.prototype.$search_data = new Vue();
const myapptable = new Vue({
    el: '#myapptable',
    data() {
    	return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dataA:null,
            dataB:null,
        }
    },
    methods:{
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
    },
    mounted(){
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
        })
    }

});
