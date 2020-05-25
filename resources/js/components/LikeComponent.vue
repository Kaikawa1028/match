<template>
    <div class="w-100 text-center mb-4">
        <div v-if="this.likeStatus == 'received'">
            <form :action="this.endpoint" method="post">
                <button type="submit" class="btn w-100 rounded-pill" :class="buttonColor">{{ buttonText }}</button>
                <input type="hidden" name="_token" :value="this.csrf">
            </form>
        </div>
        <div v-if="this.likeStatus == 'matched'">
            <a :href="this.endpoint"><button type="button" class="btn w-100 rounded-pill" :class="buttonColor">{{ buttonText }}</button></a>
        </div>
        <div v-if="this.likeStatus == '' || this.likeStatus == 'sended'">
            <button type="button" @click="clickLike" class="btn w-100 rounded-pill" :class="buttonColor">{{ buttonText }}</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            endpoint: {
                type: String,
            },
            initialLikeStatus: {
                type: String,
                default: '',
            },
        },
        data() {
            return {
                likeStatus: this.initialLikeStatus,
                csrf: document 
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),

            }
        },
        computed: {
            buttonColor() {
                switch(this.likeStatus) {
                    case '':
                        return 'btn-default'
                    case 'sended':
                         return 'btn-blue-grey'
                    case 'received':
                         return 'btn-pink'
                    case 'matched':
                         return 'btn-pink'
                }
            },
            buttonText() {
                switch(this.likeStatus) {
                    case '':
                        return 'いいねを送る'
                     case 'sended':
                         return 'いいねを取り消し'
                     case 'received':
                         return 'いいねありがとう'
                     case 'matched':
                         return 'メッセージを送る'
                }
            }
        },
        methods: {
            clickLike() {
                switch(this.likeStatus) {
                    case '':
                        this.like()
                        break
                    case 'sended':
                        this.unlike()
                        break
                    case 'received':
                        this.receive()
                        break
                }
            },
            async like() {
                const responce = await axios.put(this.endpoint)
                this.likeStatus = 'sended'
            },
            async unlike() {
                const responce = await axios.delete(this.endpoint)
                this.likeStatus = ''
            }
        },
        mounted() {
            //console.log(this.csrf)
        }
    }
</script>
