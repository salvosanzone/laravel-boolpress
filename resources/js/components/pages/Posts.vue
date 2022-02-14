<template>
  <main class="container">

    <div class="container-posts">
      <h1>I miei Post</h1>
      <div v-if="posts">
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
    <div class="container-filter">
      <h1>Filtra per:</h1>
      <div class="box">
        <h5>Categoria:</h5>
        <button class="btn-category">PHP</button>
        <button class="btn-category">PHP</button>
        <button class="btn-category">PHP</button>
        <button class="btn-category">PHP</button>
        <button class="btn-category">PHP</button>
      </div>

      <div class="box">
        <h5>Tag:</h5>
        <button class="btn-tag">Javascript</button>
        <button class="btn-tag">Javascript</button>
        <button class="btn-tag">Javascript</button>
        <button class="btn-tag">Javascript</button>
        <button class="btn-tag">Javascript</button>
        <button class="btn-tag">Javascript</button>
      </div>
    </div>

  </main>
</template>

<script>
import PostItem from '../partials/PostItem.vue';
export default {
  name: 'Posts',
  
  components: {
    PostItem
  },

  data(){
    return{
      apiUrl: 'http://127.0.0.1:8000/api/posts?page=',

      // una volta effettuata la chiamata salvo tutti i miei dati in posts, di defaul è null ma una volta effettuata la chiamata si riempe
      posts: null,

      pagination: {}
      

    }
  },

  // creo una funzione mounted che si attiva ogni volta che carico la pagina
  mounted(){
    // al caricamento della pagina richiamo la funzione
    this.getPosts();
  }, 

  
  methods: {
    // creo una funzione che fa la chiamata axios
    getPosts(page = 1){
      // creo il loader anche quando cambio pagina
      this.posts = null;
      axios.get(this.apiUrl + page)
      .then(result => {
        this.posts = result.data.data
        //console.log('ARRAY--->', this.posts);
      
        this.pagination = {
          current : result.data.current_page,
          last : result.data.last_page

        }
          console.log('ARRAY CON PAGINATE--->', this.pagination);
      })

    }
  }

}
</script>

<style lang="scss" scoped>
main{
  display: flex;
  padding: 50px;
  
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

  .container-filter{
    margin-left: 20px;
    .box{
      padding: 10px;
      text-align: center;
      margin-bottom: 20px;
    }
    button{
      border: none;
      padding: 5px;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      margin: 5px;
    }
      
      .btn-category{
        background-color:coral;
        &:hover{
          background-color:rgb(255, 215, 200);
        }
      }
      .btn-tag{
        background-color: lightgreen;
        &:hover{
          background-color:rgb(206, 241, 206);
        }
      }
  }
  
}

</style>