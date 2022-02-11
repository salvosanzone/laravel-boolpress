<template>
  <div>
    <article>
      
      <h3>
        <router-link class="link" :to="{name: 'detail', params:{slug: post.slug}}">
          {{ post.title }}
         </router-link>
      </h3>
      <p class="date">{{ post.created_at }}</p>
      <p class="text">{{ troncateText }}</p>
      <p v-if="post.category" class="text category">{{ post.category.name }}</p>
      <div>
        <span
          class="tag"
          v-if="post.tags"
          v-for="tag in post.tags"
          :key="tag.id"
        >
          {{ tag.name }}
        </span>
      </div>
    </article>
    <div>


    </div>
  </div>
</template>

<script>
export default {
  name: 'PostItem',

  props: {
    // il figlio PostItem riceve dal padre Posts, un oggetto che chiamo post
    'post' : Object
  },

  computed: {
    troncateText(){
      return this.post.content.substr(0, 50) + '...';
    },

    formaDate(){
      const d = new Date(this.post.created_at);
      let day = d.getDay()
    }
  }
}
</script>

<style lang="scss" scoped>
article{
  border: 2px solid black;
  padding: 10px;
  text-align: center;
  margin-bottom: 20px;
  h3:hover{
    cursor: pointer;
    text-decoration: underline;
  }
  p{
    margin: 5px 0;
  }
  .category{
    text-decoration-line: underline;

  }
  .tag{
    background-color: brown;
    color: white;
    border-radius: 5px;
    padding: 0 5px;
  }
  .link{
    color: black;
    text-decoration: none;
  }
}
</style>