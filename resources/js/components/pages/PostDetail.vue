<template>
  <div class="container">
    <h1>{{ post.title }}</h1>
    <p>{{ post.content }}</p>
    <p v-if="post.category" class="category">{{ post.category.name }}</p>
    <span 
      v-if="post.tags"
      v-for="tag in post.tags"
      :key="tag.id"
      class="tag"
    >
      {{ tag.name }}
    </span>
  </div>
</template>

<script>
export default {
  name: 'PostDetail',
  data(){
    return{
      apiUrl: 'http://127.0.0.1:8000/api/posts/',
      post:{
        title: '',
        content: '',
        category: {},
        tags: []
      },
      
    }

  },
  methods: {
        getApi(){
          axios.get(this.apiUrl + this.$route.params.slug)
          .then(result => {
            this.post = result.data;
            console.log(this.post);
          })
        }
      },
      mounted(){
        console.log(this.$route.params.slug);
        this.getApi();
        console.log('Eccomi!!!!!');
      }

}
</script>

<style lang="scss" scoped>
.container{
  h1,
  p{
    margin: 20px 0;
  }
  .category{
    text-decoration: underline;
  }
  .tag{
    background-color: brown;
    color: white;
    border-radius: 5px;
    padding: 0 5px;
  }
}
</style>