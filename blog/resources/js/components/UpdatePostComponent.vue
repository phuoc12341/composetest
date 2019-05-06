<template>
    <div class="row align-items-center mt-5">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" ref="titleWantUpdate" name="title" v-model="post.title">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Content</label>
                <textarea class="form-control" ref="contentWantUpdate" name="content" v-model="post.content"></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" @click="updatePost">Submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data () {
          return {
            post: {
                id: '',
                title: '',
                content: '',
            }
          };
        },

        props: {
            postWantUpdate: {
                type: Object
            }
        },

        watch: {
          postWantUpdate () {
            this.post.id = this.postWantUpdate.id;
            this.post.title = this.postWantUpdate.title;
            this.post.content = this.postWantUpdate.content;
          }
        },

        methods: {
          updatePost () {
                this.post.id = this.postWantUpdate.id;
                this.$emit('updatePost', this.post)
            }
        }
    }
</script>
