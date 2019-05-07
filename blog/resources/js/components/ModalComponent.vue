<template>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter title" name="title" v-model="postWantUpdate.title">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" placeholder="Content" name="content" v-model="postWantUpdate.content"></textarea>
            </div>
            <div class="form-group">
                <label for="postFile">File for post</label>
                <input type="file" class="form-control-file" id="postFile" name="postFile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" @click="createOrUpdatePost(createOrUpdate)"> Submit</button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import ShowPostComponent from './ShowPostComponent.vue'
    import Common from '../services/common.js'

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            ShowPostComponent,
        },

        data () {
          return {
            createUrl: laroute.route('posts.store'),
            postWantUpdate: {
               title: '',
                content: '', 
            },
            lastPost : null,
            errors: [],
          }
        },

        props: {
            listPosts: {
                type: Array,
            },
            createOrUpdate: {
                type: Object,
            }
        },

        watch: {
          createOrUpdate () {
            this.showFormUpdatePost(this.createOrUpdate);

          }
        },

        methods: {
            createOrUpdatePost (createOrUpdate) {
                if (createOrUpdate.createOrUpdate == 'create') {
                    axios.post(laroute.route('posts.store'), {
                        title: this.postWantUpdate.title,
                        content: this.postWantUpdate.content,
                    })
                    .then( response => {
                        this.lastPost = response.data.listPosts[response.data.listPosts.length -1];
                        this.$emit('showLastPostCreated', this.lastPost);
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
                } else if (createOrUpdate.createOrUpdate == 'update') {
                    axios.patch(laroute.route('posts.update', {'post' : createOrUpdate.id}), {
                        'title': this.postWantUpdate.title,
                        'content': this.postWantUpdate.content,
                    })
                    .then( response => {
                        if (response.status == 200) {
                            this.$emit('updateListPost', response.data.newPost);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
            showFormUpdatePost (createOrUpdate) {
                if (createOrUpdate.createOrUpdate == 'update') {

                    axios.get(laroute.route('posts.edit', {'post' : createOrUpdate.id}))
                      .then( response => {
                        if (response.status == 200) {
                            this.postWantUpdate = response.data.postWantUpdate;
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
                } else if (createOrUpdate.createOrUpdate == 'create') {
                    this.postWantUpdate.title = '';
                    this.postWantUpdate.content = '';
                }
            },

            // Common.create(this.createUrl, data)
            
        }
    }
</script>


    