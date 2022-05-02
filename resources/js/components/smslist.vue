<template>
    <table >
        <thead>
            <tr>
                <th>smsid</th>
                <th>sms_sendtime</th>
                <th>device_id</th>
                <th>send_number</th>
                <th>sms_content</th>
                <th>keyword</th>
                <th>noticode</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody >
            <tr class="item" v-for="item in dataA">
                <td class="smsid" >{{item.smsid}}</td>
                <td class="sms_sendtime" >{{item.sms_sendtime | timeString('YYYY-MM-DD HH:mm:ss')}}</td>
                <td class="device_id" >{{item.device_id}}</td>
                <td class="send_number" >{{item.send_number}}</td>
                <td class="sms_content" >{{item.sms_content}}</td>
                <td class="keyword" >{{item.keyword}}</td>
                <td class="noticode" >{{item.noticode}}</td>
                <td class="status" >{{item.status}}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>

    export default{
        name:'dataAPP',
         model: {
            prop: "dataBA",
        },
        props: {
            value: Function,
            dataBA: {
            type: Function,
            default: null,
            },
        },
        data(){
            return{
                dataA:{

                }
            }
        },
        computed: {
            filterList() {
                return this.dataA.filter(function (v) {return v.noticode !== 1} );
            }
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
                    }
                })
            })
        }
    }

</script>
<style>
    .id{
        font-size: 25px;
        position: relative;
        left:50px;
        right:50px;
    }
</style>
