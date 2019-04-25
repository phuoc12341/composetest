<template>
    <div class="container mb-5">
        <p>Những thứ họ mua:</p>
        <ol>
            <!--
              Ở đây chúng ta cung cấp một object "todo" cho mỗi component
              "todo-item". Bằng cách này nội dung của từng component trở nên động.
              Mỗi component cũng sẽ nhận một thuộc tính "key". Chúng ta sẽ
              nói thêm về thuộc tính này sau.
            -->
            <todo-item
                v-for="item in groceryList"
                v-bind:todo="item"
                v-bind:key="item.id">
            </todo-item>

            <div>
                <p>Thông điệp ban đầu: "{{ message }}"</p>
                <p>Thông điệp bị đảo ngược bằng tính toán (computed): "{{ reversedMessage }}"</p>
            </div>

            <div v-bind:class="classObject">
                Test binding class
            </div>

        </ol>

        <h1 v-if="ok">Mọi việc ổn cả</h1>
        <h1 v-else>Có gì đó sai sai</h1>

        <template v-if="ok">
            <h1>Anh chàng chăn lợn</h1>
            <p>Ơ này, Augustin thân mến ơi</p>
            <p>Mọi việc đều như ý, như ý, như ý</p>
        </template>

        <div v-if="Math.random() > 0.5">
            Tài
        </div>
        <div v-else>
            Xỉu
        </div>

        <div v-if="type === 'A'">A</div>
            <div v-else-if="type === 'B'">B</div>
            <div v-else-if="type === 'C'">C</div>
            <div v-else-if="type === 'D'">D</div>
            <div v-else>Chiến Sĩ không thể nhớ nổi</div>
    
        <div>
            <button v-on:click="counter += 1">Đếm cừu</button>
            <p>{{ counter }} con cừu.</p>
        </div>

        <button v-on:click="greet">Chào mừng</button>

        <div>
            <br>
            <input type="checkbox" id="com-chien-toi" value="Cơm chiên tỏi" v-model="checkedNames">
            <label for="com-chien-toi">Cơm chiên tỏi</label><br>
            <input type="checkbox" id="dot-bi-xao-toi" value="Đọt bí xào tỏi" v-model="checkedNames">
            <label for="dot-bi-xao-toi">Đọt bí xào tỏi</label><br>
            <input type="checkbox" id="canh-rau-rung" value="Canh rau rừng" v-model="checkedNames">
            <label for="canh-rau-rung">Canh rau rừng</label>
            <br>
            <span>Món đã chọn: {{ checkedNames }}</span>
        </div>

        <div>
            <br>
            <input type="radio" id="cac-mon-rau" value="Các món rau" v-model="picked">
            <label for="cac-mon-rau">Các món rau</label><br>
            <input type="radio" id="cac-mon-thit" value="Các món thịt" v-model="picked">
            <label for="cac-mon-thit">Các món thịt</label><br>
            <span>Đã chọn: {{ picked }}</span>
        </div>

        <div>
            <br>
            <select v-model="selected">
                <option disabled value="">Vui lòng chọn món</option>
                <option>Đọt bí xào tỏi</option>
                <option>Canh bông điên điển</option>
                <option>Lẩu nấm</option>
            </select>
            <br>
            <span>Món đã chọn: {{ selected }}</span>
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
                groceryList: [
                    { id: 0, text: 'Cà pháo' },
                    { id: 1, text: 'Mắm tôm' },
                    { id: 2, text: 'Miễn ăn được là được' },
                ],
                message: 'người đông bến đợi thuyền xuôi ngược',
                isActive: true,
                error: null,
                ok: true,
                counter: 0,
                type: '',
                name: 'Vue.js',
                checkedNames: [],
                picked: '',
                selected: '',
            }
        },

        computed: {
            reversedMessage: function () {
                return this.message.split(' ').reverse().join(' ')
            },
            classObject: function () {
                return {
                    active: this.isActive && !this.error,
                    'text-danger': this.error && this.error.type === 'fatal'
                }
            }
        },

        methods: {
            greet: function (event) {
                alert('Xin chào ' + this.name + '!');
                if (event) {
                    alert(event.target.tagName)
                }
            }
        }
    }
</script>
