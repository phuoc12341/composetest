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

                <h1>{{ $t('welcomeMsg') }}</h1>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="createOrUpdate = {createOrUpdate: 'create'}">
                  Create Post
                </button>

                <ModalComponent :createOrUpdate="createOrUpdate" @showLastPostCreated="lastPost = $event" @updateListPost="postUpdated = $event"></ModalComponent>

            </div>

            <ShowPostComponent :lastPost="lastPost" @showModalUpdatePost="showModalUpdatePost($event)" :postUpdated=" postUpdated"></ShowPostComponent>
        </div>
    </div>
</template>

<script>
    import ShowPostComponent from './ShowPostComponent.vue'
    import Common from '../services/common.js'
    import ModalComponent from './ModalComponent.vue'

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            ShowPostComponent,
            ModalComponent,
        },

        data () {
          return {
            createOrUpdate: null,
            postUpdated: null,
            posts: {
               title: '',
                content: '', 
            },
            lastPost : null,
            errors: [],
          }
        },

        methods: {
          createPost (data) {
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
            },
            showModalUpdatePost (updateFormData) {
                this.createOrUpdate = updateFormData
            }
        }
    }
</script>


    