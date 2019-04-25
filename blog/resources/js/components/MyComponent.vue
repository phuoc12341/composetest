<template>
    <div>
        <span v-bind:title="message">
            {{ message }}
        </span>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                message: 'Bạn đã mở trang này vào ' + new Date().toLocaleString()
            }
        }
    }
</script>
