<template>
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="error" v-if="errors.length">
                    <span v-for="err in errors">
                        {{ err }}
                    </span>
                    <hr>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter title" name="title" v-model="posts.title">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" placeholder="Content" name="content" v-model="posts.content"></textarea>
                </div>
                <div class="form-group">
                    <label for="postFile">File for post</label>
                    <input type="file" class="form-control-file" id="postFile" name="postFile">
                </div>
                <button type="submit" class="btn btn-primary" @click="createPost">Submit</button>
            </div>
            <ShowPostComponent :lastPost="lastPost"></ShowPostComponent>
        </div>
    </div>
</template>

<script>
    import ShowPostComponent from './ShowPostComponent.vue'

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            ShowPostComponent,
        },

        data () {
          return {
            posts: {
               title: '',
                content: '', 
            },
            lastPost : null,
            errors: [],
          }
        },

        methods: {
          createPost () {
            axios.post(laroute.route('posts.store'), {
                title: this.posts.title,
                content: this.posts.content,
              })
              .then( response => {
                this.lastPost = response.data.listPosts[response.data.listPosts.length -1];
              })
              .catch( error => {
                console.log(error);
                this.errors = [];
                if(error.response.data.errors.title) {
                    this.errors.push(error.response.data.errors.title)
                };
                if(error.response.data.errors.content) {
                    this.errors.push(error.response.data.errors.content)
                }
              });
            }
        }
    }
</script>


    