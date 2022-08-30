<template>
    <div>
        <button v-if="!disabled" :class="style_class" type="submit" @click="click">{{text}}</button>
        <button v-else disabled  :class="style_class" type="submit">
            <!-- スピナー -->
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span></div>
            送信中
        </button>
    </div>
</template>

<script>
    /*
    --------------------------------------------------------------------------
        [ 使い方 ]
        <submit-button-component
            style_class="btn btn-danger" // スタイルクラスの指定
            text="確定"                  // ボタンテキストの指定
        />
    --------------------------------------------------------------------------
    */

    export default {
        data : function() {
            return{

                disabled: false,

            }
        },
        props: {
            // ボタンのスタイルクラス
            style_class: { type: String, default: 'btn btn-primary',},

            // ボタンテキスト
            text: { type: String, default: '送信',},
        },
        methods:{

            click : function(){ this.disabled = true; }

        }
    }
</script>
