<template>
    <div class="container">
          <span v-if="seen">Thoắt ẩn thoắt hiện</span>

        <div>
            <ol>
                <li v-for="todo in todos">
                  {{ todo.text }}
                </li>
            </ol>
        </div>
        
        <div>
            <p>{{ message1 }}</p>
            <button v-on:click="reverseMessage">Reverse Message</button>
        </div>

        <div>
            <p>{{ message2 }}</p>
            <input v-model="message2">
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() { 
            return {
                seen: true,
                todos: [
                    { text: 'Học JavaScript' },
                    { text: 'Học Vue' },
                    { text: 'Xây dựng cái gì đó hay ho' }
                ],
                message1: 'qua lại khách chờ sông lặng sóng',
                message2: 'Hãy sửa thông điệp này',
            }
        },

        methods: {
            reverseMessage: function () {
                this.message1 = this.message1.split(' ').reverse().join(' ')
            }
        }

    }
</script>
