<template>
    <div>

        <form :action="route" v-show="test" method="POST">
            <input v-for="(input, key) in inputs" :key="key"
            type="text" :name="key" :value="input"
            >
            <button type="submit" class="btn btn-primary btn-sm">{{btn_text}}</button>
        </form>

        <button class="btn btn-sm"
        :class="{'btn-success':inputs.keep, 'text-success fw-bold':!inputs.keep}"
        @click="click" type="button">{{btn_text}}</button>


    </div>
</template>
<script>
    export default {
        data : function() {
            return{

                test: false,

                btn_text: 'フォローする',

                inputs:{
                    _token: document.querySelector('[name="csrf_token"]').content,
                    user_id: '',
                    creater_user_id: '',
                    keep: 1,// keepの状態が１のとき、送信内容は0（状態と送信内容は逆に登録）
                },


            }
        },
        props: {
            route:           { type: String, default: '', },
            user_id:         { type: String, default: '', },
            creater_user_id: { type: String, default: '', },
            keep:            { type: String, default: '1', },

        },
        mounted() {

            this.inputs.user_id = this.user_id;
            this.inputs.creater_user_id = this.creater_user_id;
            this.inputs.keep = (this.keep==1) ? 0 : 1 ;// keepの状態が１のとき、送信内容は0（状態と送信内容は逆に登録）
            this.btn_text    = !this.inputs.keep ?  'フォロー中' : 'フォローする';

        },
        methods:{

            click: function(){

                // [ 非同期通信 ]
                fetch( this.route, {
                    method: 'POST',
                    body: new URLSearchParams( this.inputs ),
                })
                .then(response => {
                    if(!response.ok){ alert('データ送信エラーが発生しました。'); }
                    // return response.json();
                })
                .then(json => {
                    // 表示の切り替え
                    this.inputs.keep = !this.inputs.keep ? 1 : 0 ;
                    this.btn_text    = !this.inputs.keep ?  'フォロー中' : 'フォローする';

                    // console.log( json );
                })


            },
        },
    }
</script>
