<template>
    <div class="show-post  mt-5">
        <div class="row align-items-center" v-for="post in listPosts" :key="post.id">
            <div class="col-4">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" :value="post.title" disabled="true">
                </div>
            </div>
            <div class="col-4">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" :value="post.content" disabled="true">
                </div>
            </div>
            <div class="col-2 text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="$emit('showModalUpdatePost', {createOrUpdate: 'update', id: post.id})">
                  Update
                </button>
            </div>
            <div class="col-2 text-center">
                <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {

        },

        data () {
          return {
            listPosts: [],
            showFormUpdatePost: false,
          };
        },

        mounted: function () {
            this.showListPost();
        },

        props: {
            lastPost: {
                type: Object
            },
            postUpdated: {
                type: Object
            }
        },

        watch: {
          lastPost () {
            this.listPosts.push(this.lastPost);
          },
          postUpdated () {
            this.updateListPostWhenPostUpdated(this.postUpdated);
          }
        },

        methods: {
          showListPost () {
            console.log('test')
            axios.get(laroute.route('posts.index'))
              .then( response => {
                this.listPosts = response.data.listPosts;
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .then(function () {
                // always executed
              });
          },
          deletePost (id) {
            axios.delete(laroute.route('posts.destroy', {'post' : id }))
              .then( response => {
                if (response.status == 200) {
                    this.listPosts.pop(id);
                }
              })
              .catch(function (error) {
                console.log(error);
              });
          },
          updateListPostWhenPostUpdated(postUpdated) {
            this.listPosts.findIndex((post) => post.id == postUpdated.id);
            this.listPosts.splice(this.listPosts.findIndex((post) => post.id == postUpdated.id), 1, postUpdated);
          }
        }
    }
</script>
