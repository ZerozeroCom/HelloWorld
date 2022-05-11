<template>
    <div>
        <div class="card row m-2 " style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0 " style="border-radius:10px 10px 0px 0px!important;">搜尋</h5>
            <div class="col wordStyle">
                <form>
                    <div class="row m-3">
                            <div class="col-md-3 ">
                                <label for="sesend_number" class="col-form-label">簡訊發送號碼　</label>
                                <input type="number" class="col-form-control" v-model.trim="send_number" @keydown.enter="allsearch">
                            </div>
                            <div class="col-md-3" >
                                <label for="sesms_content" class="col-form-label">　關鍵字　</label>
                                <input type="text" class="col-form-control" v-model.trim="sms_keyword" @keydown.enter="allsearch">
                            </div>
                            <div class="col-md-3">
                                <label for="sesms_content" class="col-form-label">簡訊內容　</label>
                                <input type="text" class="col-form-control" v-model.trim="sms_content" @keydown.enter="allsearch">
                            </div>
                            <div class="col-md-3 " >
                                <label for="sesnoticode" class="col-form-label">　　分類　</label>
                                <select type="text" class="col-form-control"  v-model.trim="noticode" @keydown.enter="allsearch">
                                    <option></option>
                                    <option value="1">通知</option>
                                    <option value="0">忽視</option>
                                </select>
                            </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-md-3 ">
                            <label for="sedev_name" class="col-form-label">　　裝置名稱　</label>
                            <input type="text" class="col-form-control" v-model.trim="dev_name" @keydown.enter="allsearch">
                        </div>
                        <div class="col-md-3 ">
                            <label for="sedev_businesses" class="col-form-label">裝置商戶　</label>
                            <input type="text" class="col-form-control" v-model.trim="dev_businesses" @keydown.enter="allsearch">
                        </div>
                        <div class="col-md-3">
                            <label for="sedev_number" class="col-form-label">裝置號碼　</label>
                            <input type="number" class="col-form-control" v-model.trim="dev_number" @keydown.enter="allsearch">
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-8 btn-group"  role="group" >
                        <label for="" class="col-form-label my-auto">快速選取:</label>
                        <button type="button" class="m-2 btn btn-outline-info" v-on:click="lastmonth()">上月</button>
                        <button type="button" class="m-2 btn btn-outline-success" v-on:click="thismonth()">今月</button>
                        <button type="button" class="m-2 btn btn-outline-primary" v-on:click="before_yesterday()">前日</button>
                        <button type="button" class="m-2 btn btn-outline-info" v-on:click="date_yesterday()">昨日</button>
                        <button type="button" class="m-2 btn btn-outline-success" v-on:click="date_today()">今日</button>
                        <button type="button" class="m-2 btn btn-outline-dark" v-on:click="date_clear()">清除日期</button>
                        <button type="button" class="m-2 btn btn-outline-dark" v-on:click="all_clear()">清除條件</button>
                    </div>
                    <div class="col my-auto">
                        <label for="sedev_number" class="col-form-label">自訂單日搜尋:</label>
                        <input type="date" class="col-form-control" v-model.trim="sms_date" @keydown.enter="allsearch">

                    </div>
                    <div class="col-1" hidden>
                        <label for="sedev_month" class="col-form-label">自訂整月搜尋: (例: 2022-01)</label>
                        <div class="col-md-1">
                                <input clas4s="form-control " id="sedev_month" placeholder="yyyy-MM" type="text" maxlength="7" oninput = "value=value.replace(/[^\d-]|-{2}|\d{5}|^\w{1,3}-/g,'')">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn m-3 btn-primary " v-on:click="allsearch()" style="font-weight: 600;">送出</button>
        </div>
        <div>
            <button type="button" class="btn m-3 btn-danger" id="se_del_sms" disabled>依照本頁搜尋結果刪除</button>
            <button type="button" class="btn m-2 btn btn-dark " v-on:click="switch_stop()">停止自動刷新</button>
            <label v-if="stop==false" style="color: red">已暫停自動刷新，重開請再次點擊或按F5</label>


        </div>
        <div class="card m-2" style="border-radius:10px!important;">
            <h5 class="card-header bg-infoCool py-3 row ml-0 mr-0" style="border-radius:10px 10px 0px 0px!important;">簡訊列表</h5>
            <div class=" m-4"  >

                <div class="row">
                    <div class="col">顯示第 {{pagefirst}} 至 {{pagelast}}項結果，共 {{pagelen}}項 <label v-if="pagelen < alllen"> (從 {{alllen}} 項結果過濾)</label><br>
                        顯示<select type="text" class=""  v-model="pagenum" >
                            <option>50</option>
                            <option>100</option>
                            <option>500</option>
                            <option>5</option>
                        </select>項結果
                    </div>
                    <div class="col">{{nowpage}}</div>
                    <div class="col">
                        <button class="btn" v-on:click="nowpage=1">首頁</button><button class="btn" v-on:click="nowpagepre()" >上一頁</button><template v-for="a in totalpage"><button class="btn" v-on:click="nowpage=a">{{a}}</button></template><button class="btn" v-on:click="nowpagenext()" >下一頁</button><button class="btn" v-on:click="nowpage=totalpage">尾頁</button>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>發送時間</th>
                            <th>裝置名稱</th>
                            <th>商戶</th>
                            <th>裝置號碼</th>
                            <th>發送號碼</th>
                            <th>簡訊內容</th>
                            <th>分類</th>
                            <th>關鍵字</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item" v-for="item in showfield" :key="item.smsid">

                            <td class="sms_sendtime" >{{item.sms_sendtime | timeString('YYYY-MM-DD HH:mm:ss')}}</td>
                            <td class="device_id" >{{item.device.name}}</td>
                            <td class="smsid" >{{item.device.businesses}}</td>
                            <td class="status" >{{item.device.number}}</td>
                            <td class="send_number" >{{item.send_number}}</td>
                            <td class="sms_content" >{{item.sms_content}}</td>
                            <td class="noticode" >{{item.noticode}}</td>
                            <td class="keyword" >{{item.keyword}}</td>

                            <td><button class="btn btn-danger " :data-id="item.smsid" v-on:click="deletesms(item)">刪除</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">顯示第 {{pagefirst}} 至 {{pagelast}} 項結果，共 {{pagelen}}項 <label v-if="pagelen < alllen"> (從 {{alllen}} 項結果過濾)</label><br>
                        顯示<select type="text" class=""  v-model="pagenum" >
                            <option>50</option>
                            <option>100</option>
                            <option>500</option>
                            <option>5</option>
                        </select>項結果
                    </div>
                    <div class="col">{{nowpage}}</div>
                    <div class="col">
                        <button class="btn" v-on:click="nowpage=1">首頁</button><button class="btn" v-on:click="nowpagepre()" >上一頁</button><template v-for="a in totalpage"><button class="btn" v-on:click="nowpage=a">{{a}}</button></template><button class="btn" v-on:click="nowpagenext()" >下一頁</button><button class="btn" v-on:click="nowpage=totalpage">尾頁</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default{
        name: 'datatable',
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
            var that=this;
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
                    that.dataA.splice(that.dataA.indexOf(a),1);
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
        setTimeout(this.refresh(),7000);
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

};


</script>
<style>
    .id{
        font-size: 25px;
        position: relative;
        left:50px;
        right:50px;
    }
</style>
