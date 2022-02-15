<template>
  <main class="container">
    <div v-if="success">
      <div v-if="posts" class="wrapper">
      <h1>I miei post</h1>
      <PostItem 
      v-for="post in posts"
      :key="post.id"
      :post="post"
      />

      <div class="navigation">
        <button
          @click="getPosts(pagination.current - 1)"
          :disabled="pagination.current === 1"
          > 
          << prev
        </button>

        <button
          v-for="i in pagination.last"
          :key="i"
          @click="getPosts(i)"
          :disabled="pagination.current === i"
        >
          {{ i }}
        </button>

        <button
          @click="getPosts(pagination.current + 1)"
          :disabled="pagination.current === pagination.last"
        > 
          >> next
        </button>
      </div>
    </div>

    <div v-else class="loader">
      <h3>Loading...</h3>
    </div>
    </div>
    
    <div v-else>
      <h2>{{ error_msg }}</h2>
    </div>
    
    <Sidebar
    :categories="categories"
    :tags="tags"
    @getPostCategory="getPostCategory"
    @getPostTag="getPostTag"
    />

  </main>
</template>

<script>
import PostItem from '../partials/PostItem.vue';
import Sidebar from '../partials/Sidebar.vue';

export default {
  name: 'Posts',
  
  components: {
    PostItem,
    Sidebar,
  },

  data(){
    return{
      apiUrl: 'http://127.0.0.1:8000/api/posts',

      // una volta effettuata la chiamata salvo tutti i miei dati in posts, di defaul è null ma una volta effettuata la chiamata si riempe
      posts: null,
      pagination: {},

      // creo due array vuoti che si popolano alla chiamata getApi()
      categories: [],
      tags: [],

      success: true,
      error_msg: ''


      

    }
  },

  // creo una funzione mounted che si attiva ogni volta che carico la pagina
  mounted(){
    // al caricamento della pagina richiamo la funzione
    this.getPosts();
  }, 

  
  methods: {
    getPostCategory(slug_category){
      //console.log(slug_category);
      // l'argomento che mi viene giu(la categoria) lo devo andare a concatenare nell url nel momento in cui faccio una chiamata
      axios.get(this.apiUrl + '/postcategory/' + slug_category)
        .then(result => {
          this.posts = result.data.category.posts
          if(!result.data.success){
            this.error_msg = result.data.error;
            this.success = false;
          } 
          //console.log('al click ====>', this.posts);
        })
    },
    getPostTag(slug_tag){
      //console.log('click tag ====>', slug_tag);
      axios.get(this.apiUrl + '/posttag/' + slug_tag)
        .then(result => {
          this.posts = result.data.tag.posts
          if(!result.data.success){
            this.error_msg = result.data.error;
            this.success = false;
          } 
          console.log('result ====>', this.posts);
        })
    },
    // creo una funzione che fa la chiamata axios
    getPosts(page = 1){
      // creo il loader anche quando cambio pagina
      this.posts = null;
      axios.get(this.apiUrl +'?page=' + page)
      .then(result => {
        this.posts = result.data.posts.data
        //console.log('ARRAY--->', this.posts);

        // salvo dentro un array le categorie e i tags
        this.categories = result.data.categories;
        this.tags = result.data.tags;
        //console.log('tags----->', this.tags);
      
        this.pagination = {
          current : result.data.posts.current_page,
          last : result.data.posts.last_page

        }
          //console.log('ARRAY CON PAGINATE--->', this.pagination);
      })

    }
  }

}
</script>

<style lang="scss" scoped>
main{
  padding: 50px;
  .wrapper{
    
  }
  
  h1{
    margin-bottom: 10px;
  }
  .navigation{
    margin-bottom: 100px;
    button{
      padding: 5px;
      cursor: pointer;
    }
  }

  .loader{
    text-align: center;
    padding-top: 150px;
  }

  
  
}

</style>